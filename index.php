<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESIS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h4>formulario de votación</h4>
    <hr>
    <form action="" id="myForm">
        <div class="form-group">
            <label for="nombre">Nombre y Apellido:</label>
            <input type="text" id="nombre" name="nombre">
        </div>
        <div id="error-nombre" class="mensaje-error"><span>El campo nombre no puede quedar en blanco</span></div>
        <div class="form-group">
            <label for="alias">Alias:</label>
            <input type="text" id="alias" name="alias">
        </div>
        <div id="error-alias" class="mensaje-error"><span>El campo alias debe tener más de 5 caracteres y debe contener letras y números</span></div>
        <div class="form-group">
            <label for="rut">RUT:</label>
            <input type="text" id="rut" name="rut">
        </div>
        <div id="error-rut" class="mensaje-error"><span>El campo rut no es válido</span></div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>
        <div id="error-email" class="mensaje-error"><span>El campo email no es válido</span></div>
        <div class="form-group">
            <!-- region -->
            <label for="lista-regiones">Región:</label>
            <select name="lista-regiones" id="lista-regiones">
            </select>
        </div>
        <div class="form-group">
            <!-- comuna -->
            <label for="lista-comunas">Comuna:</label>
            <select name="lista-comunas" id="lista-comunas">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <!-- candidato -->
            <label for="lista-candidatos">Candidato:</label>
            <select name="lista-candidatos" id="lista-candidatos">
            </select>
        </div>
        <div class="form-group">
            <span>Como se enteró de Nosotros:</span>
            <div class="checkbox-group">
                <label>
                <input id="opcion1" type="checkbox" name="opcion1" value="web">
                Web
                </label>
                <label>
                <input id="opcion2" type="checkbox" name="opcion2" value="tv">
                TV
                </label>
                <label>
                <input id="opcion3" type="checkbox" name="opcion3" value="redes-sociales">
                Redes Sociales
                </label>
                <label>
                <input id="opcion4" type="checkbox" name="opcion4" value="amigo">
                Amigo
                </label>
            </div>
        </div>
        <div id="error-checkbox" class="mensaje-error"><span>Debe elegir al menos dos opciones</span></div>
        <button type="submit">Votar</button>
        <div id="error-formulario" class="mensaje-error"><span></span></div>
    </form>
    <script src="index.js"></script>
</body>
</html>