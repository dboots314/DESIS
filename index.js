window.DESIS = function() {
    function cargarRegiones() {
        // obtener el elemento select del HTML
        let selectRegiones = document.getElementById("lista-regiones");
    
        // hacer una petición Ajax al archivo PHP que devuelve el array JSON de candidatos
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'obtener_regiones.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                // convertir la respuesta JSON en un array de JavaScript
                let regiones = JSON.parse(this.responseText);
                
                // agregar cada candidato como una opción en el elemento select
                regiones.forEach(function(region) {
                    let opcion = document.createElement("option");
                    opcion.text = region.nombre;
                    opcion.value = region.id;
                    selectRegiones.add(opcion);
                });
            }
        };
        xhr.send();
    }

    function cargarComunas() {
        document.getElementById('lista-regiones').addEventListener('change', async () => {
            const region_id = document.getElementById('lista-regiones').value;
            try {
                const response = await fetch(`obtener_comunas.php?region_id=${region_id}`);
                const data = await response.json();
                // vaciar el select de comunas
                document.getElementById('lista-comunas').innerHTML = '';
                // agregar las opciones de comunas
                data.forEach((comuna) => {
                    const option = document.createElement('option');
                    option.value = comuna.id;
                    option.text = comuna.nombre;
                    document.getElementById('lista-comunas').add(option);
                })
            } catch (error) {
                // mostrar un mensaje de error
                alert('error al obtener las comunas.');
                console.log(error);
            }
        })
    }

    function cargarCandidatos() {
        // obtener el elemento select del HTML
        let selectCandidatos = document.getElementById("lista-candidatos");
    
        // hacer una petición Ajax al archivo PHP que devuelve el array JSON de candidatos
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'obtener_candidatos.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                // convertir la respuesta JSON en un array de JavaScript
                let candidatos = JSON.parse(this.responseText);
    
                // agregar cada candidato como una opción en el elemento select
                candidatos.forEach(function(candidato) {
                    let opcion = document.createElement("option");
                    opcion.text = candidato.nombre;
                    opcion.value = candidato.id;
                    selectCandidatos.add(opcion);
                });
            }
        };
        xhr.send();
    }

    cargarRegiones();
    cargarComunas();
    cargarCandidatos();

    function mostrarDiv(id) {
        document.querySelector(id).style.display = 'block';
    }

    function ocultarDiv(id) {
        document.querySelector(id).style.display = 'none';
    }

    const form = document.querySelector('#myForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // evitar que el formulario se envíe de forma predeterminada

        const div = document.querySelector('#error-formulario');
        ocultarDiv('#error-formulario');

        const nombreInput = document.querySelector('#nombre');
        const aliasInput = document.querySelector('#alias');
        const rutInput = document.querySelector('#rut');
        const emailInput = document.querySelector('#email');

        const nombre = nombreInput.value;
        const alias = aliasInput.value.trim();
        const rut = rutInput.value.trim();
        const email = emailInput.value.trim();

        // validar el campo nombre
        if (nombre.length === 0) {
            mostrarDiv('#error-nombre');
            return;
        } else {
            ocultarDiv('#error-nombre');
        }

        if (!/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{5,}$/.test(alias)) {
            mostrarDiv('#error-alias');
            return;
        } else {
            ocultarDiv('#error-alias');
        }        

        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rut)) {
            mostrarDiv('#error-rut');
            return;
        } else {
            ocultarDiv('#error-rut');
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            mostrarDiv('#error-email');
            return;
        } else {
            ocultarDiv('#error-email');
        }

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let countChecked = 0;

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                countChecked++;
            }
        });

        if (countChecked >= 2) {
            ocultarDiv('#error-checkbox');
        } else {
            mostrarDiv('#error-checkbox');
            return;
        }


        const selectRegiones = document.querySelector('#lista-regiones');
        const selectComunas = document.querySelector('#lista-comunas');
        const selectCandidatos = document.querySelector('#lista-candidatos');
        const regionSeleccionada = selectRegiones.options[selectRegiones.selectedIndex].textContent;
        const comunaSeleccionada = selectComunas.options[selectComunas.selectedIndex].textContent;
        const candidatoSeleccionado = selectCandidatos.options[selectCandidatos.selectedIndex].textContent;
        const opcion1 = document.querySelector('#opcion1');
        const opcion2 = document.querySelector('#opcion2');
        const opcion3 = document.querySelector('#opcion3');
        const opcion4 = document.querySelector('#opcion4');

        // enviar el formulario y guardar en una tabla
        const data = {
            nombre: nombre,
            alias: alias,
            rut: rut,
            email: email,
            region: regionSeleccionada,
            comuna: comunaSeleccionada,
            candidato: candidatoSeleccionado,
            opcion1: opcion1.checked,
            opcion2: opcion2.checked,
            opcion3: opcion3.checked,
            opcion4: opcion4.checked
        }

        // enviar los datos al archivo PHP
        fetch('guardar_datos.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log(data.message); // mostrar mensaje de exito en la pagina
                div.innerHTML = `<span>${data.message}</span>`;
                mostrarDiv('#error-formulario');
            } else {
                console.log(data.message); // mostrar mensaje de error en la pagina
                div.innerHTML = `<span>${data.message}</span>`;
                mostrarDiv('#error-formulario');
            }
        })
        .catch(error => {
            console.error(error.message); // mostrar mensaje de error en la pagina
            div.innerHTML = `<span>${error.message}</span>`;
            mostrarDiv('#error-formulario');
            throw new Error('Error al guardar');
        }); 
    });
};

DESIS();