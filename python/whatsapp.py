import pymysql
import datetime
import pywhatkit
import time

# Conexión a la base de datos
conexion = pymysql.connect(
    host="localhost",
    user="root",         # ← Reemplaza
    password="",  # ← Reemplaza
    database="siith"     # ← Reemplaza
)

# Fecha actual
hoy = datetime.date.today()
dia = hoy.day
mes = hoy.month

# Lista de personas (nombre completo y celular)
personas = []

# Obtener datos de personas que cumplen años
with conexion.cursor() as cursor:
    consulta = """
        SELECT nombre, apellido_paterno, apellido_materno, celular
        FROM profesionales_datos_generales
        WHERE DAY(fecha_nacimiento) = %s AND MONTH(fecha_nacimiento) = %s
    """
    cursor.execute(consulta, (dia, mes))
    resultados = cursor.fetchall()

    for fila in resultados:
        nombre, ap_paterno, ap_materno, celular = fila
        if celular:
            # Asegurar formato con +52
            if not celular.startswith("+"):
                celular = "+52" + celular
            nombre_completo = f"{nombre} {ap_paterno} {ap_materno}".strip()
            personas.append((nombre_completo, celular))

conexion.close()

# Enviar mensajes personalizados
for nombre_completo, numero in personas:
    mensaje = f"🎉 ¡Feliz cumpleaños, {nombre_completo}! 🥳\n\nTe deseamos un día lleno de alegría y éxitos. 🎂🎁"
    print(f"Enviando mensaje a {nombre_completo} ({numero})")
    try:
        pywhatkit.sendwhatmsg_instantly(numero, mensaje, wait_time=10, tab_close=True)
        time.sleep(20)  # Espera para evitar errores
    except Exception as e:
        print(f"Error al enviar mensaje a {numero}: {e}")
