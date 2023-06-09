window.onload = ()  => {
    //caputaramos todos los botones
    const displayValorAnterior = document.getElementById('valor-anterior');
    const displayValorActual = document.getElementById('valor-actual');
    const operadores = document.querySelectorAll('.operador');
    const botonesNumeros = document.querySelectorAll('.numbers'); 
    //botones especiales
    const deletBtn = document.getElementById('deleted-btn');
    const equalBtn = document.getElementById('equal-result');
    const CleanBtn = document.getElementById('cleanBtn');
    const dotBtn = document.getElementById('punto');

   

    operadores.forEach(operador => {
        operador.addEventListener('click', () => {
            let operadorValue = operador.innerText;
            let valorActualDisplay = displayValorActual.value;
            valorActualDisplay += operadorValue;
            displayValorActual.value = valorActualDisplay;
            
        })
    })

    botonesNumeros.forEach(boton => {
        boton.addEventListener('click', () =>{
            let botonValue = boton.innerText;
            let valorActualDisplay = displayValorActual.value;

            valorActualDisplay += botonValue
            displayValorActual.value = valorActualDisplay;
        })
    })

    equalBtn.addEventListener('click', () => {
        const expresion = displayValorActual.value;
        const resultado = eval(expresion);
        
        displayValorActual.value = expresion;
        displayValorAnterior.value = resultado;
    })

    CleanBtn.addEventListener('click', () => {
        displayValorActual.value = '';
        displayValorAnterior.value = '';
    })

    deletBtn.addEventListener('click', () => {
        let valorActual = displayValorActual.value;
        valorActual = valorActual.slice(0,-1);
        displayValorActual.value = valorActual;
    })

}
