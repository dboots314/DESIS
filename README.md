# DESIS : Prueba de diagnostico
## Instrucciones

Para instalar el proyecto se deben seguir los siguientes pasos:

1. Descarga o clonar el repositorio.
2. Instala un servidor web: Puedes usar Apache o Nginx. Si estás utilizando Windows, puedes descargar e instalar XAMPP, que incluye Apache y PHP. En caso de que estes usando Mac, puedes descargar e instalar MAMP que cumple la misma función que XAMPP. 
3. Configura las credenciales de la base de datos: 
	- usuario: root
	- contraseña: root
4. Ejecuta el archivo SQL 'setup_database.sql' para crear las tablas e insertar los datos correspondientes.
5. Copia la carpeta DESIS en la raíz del servidor web donde se almacenarán los archivos del sitio web. En Linux, la carpeta se suele llamar "var/www/html" y en XAMPP, "htdocs". Una vez que tengas la carpeta creada, sigue estos pasos:
6. Abre el navegador web y escribe la dirección del sitio web en la barra de direcciones. En Linux, la dirección será "[http://localhost/DESIS](http://localhost/nombre-del-directorio)" y en XAMPP, "[http://localhost:puerto/DESIS](http://localhost:puerto/nombre-del-directorio)". Si todo se ha configurado correctamente, deberías ver el sitio web.