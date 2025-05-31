import sys
import json
import mysql.connector
import numpy as np
from transformers import pipeline
from sklearn.neural_network import MLPClassifier
from sklearn.feature_extraction.text import TfidfVectorizer

emociones_dict = {
    "anger": 0, "disgust": 1, "fear": 2,
    "joy": 3, "neutral": 4, "sadness": 5, "surprise": 6
}

if len(sys.argv) < 3:
    print(json.dumps({"error": "Faltan argumentos: emoción y usuario_id"}))
    sys.exit(1)

emocion_objetivo = sys.argv[1].lower()
usuario_id = int(sys.argv[2])

# Mapeo de emociones en español a las del modelo
mapa_emociones_esp = {
    "feliz": "joy",
    "enojado": "anger",
    "triste": "sadness",
    "sorprendido": "surprise",
    "neutral": "neutral",
    "miedo": "fear",
    "asco": "disgust"
}

# Traducir la emoción objetivo si está en español
emocion_objetivo = mapa_emociones_esp.get(emocion_objetivo, emocion_objetivo)

def obtener_conexion():
    return mysql.connector.connect(host="localhost", user="root", password="", database="libreria")

def cargar_libros():
    conn = obtener_conexion()
    cursor = conn.cursor()
    cursor.execute("SELECT id_libro, titulo, descripcion, genero FROM libros")
    libros = cursor.fetchall()
    conn.close()
    return libros

# Cambiado return_all_scores por top_k=None para evitar warning
modelo_emociones = pipeline(
    "text-classification",
    model="j-hartmann/emotion-english-distilroberta-base",
    top_k=None
)

libros_raw = cargar_libros()
libros = []
descripciones = []
emociones_detectadas = []

for libro_id, titulo, descripcion, genero in libros_raw:
    resultado = modelo_emociones(descripcion)[0]
    emocion = max(resultado, key=lambda x: x['score'])['label'].lower()
    if emocion in emociones_dict:
        libros.append((libro_id, titulo, descripcion, genero, emocion))
        descripciones.append(descripcion)
        emociones_detectadas.append(emocion)

vectorizador = TfidfVectorizer()
X = vectorizador.fit_transform(descripciones)
y = np.array([emociones_dict[e] for e in emociones_detectadas])

modelo_general = MLPClassifier(hidden_layer_sizes=(10,), max_iter=1000, random_state=42)
modelo_general.fit(X, y)

def entrenar_modelo_personalizado(uid):
    conn = obtener_conexion()
    cursor = conn.cursor()
    cursor.execute("""
        SELECT l.descripcion, i.emocion
        FROM interacciones i
        JOIN libros l ON i.id_libro = l.id_libro
        WHERE i.id_usuario = %s
    """, (uid,))
    datos = cursor.fetchall()
    conn.close()

    if len(datos) < 5:
        return None

    descripciones_u, emociones_u = zip(*datos)
    X_u = vectorizador.transform(descripciones_u)
    y_u = np.array([emociones_dict[e] for e in emociones_u if e in emociones_dict])

    modelo_u = MLPClassifier(hidden_layer_sizes=(10,), max_iter=1000, random_state=42)
    modelo_u.fit(X_u, y_u)
    return modelo_u

modelo_personal = entrenar_modelo_personalizado(usuario_id)
modelo = modelo_personal if modelo_personal else modelo_general

X_libros = vectorizador.transform([desc for _, _, desc, _, _ in libros])
predicciones = modelo.predict(X_libros)
objetivo_idx = emociones_dict.get(emocion_objetivo)

recomendaciones = []
for i, (libro_id, titulo, descripcion, genero, emocion_detectada) in enumerate(libros):
    if predicciones[i] == objetivo_idx:
        recomendaciones.append({
            "id_libro": libro_id,
            "titulo": titulo,
            "descripcion": descripcion,
            "genero": genero
        })

recomendaciones = sorted(recomendaciones, key=lambda x: x['genero'])

print(json.dumps({
    "emocion": emocion_objetivo,
    "recomendaciones": recomendaciones
}, ensure_ascii=False))
