const cuestionario = [
    {
        pregunta : 'Como se llama la espada que porta guts despues del eclipse?',
        respuestas:{
            a:'DragonSlayer',
            b:'Espadon',
            c:'Zweihander'
        },
        respuestaCorrecta:'a'   
    },//pregunta 1
    {
        pregunta: 'Cual es el nombre del compañero de viaje de guts?',
        respuestas: {
            a:'Puck',
            b:'Casca',
            c:'Griffith'
        },
        respuestaCorrecta:'a'
    },//pregunta 2
    {
        pregunta: '¿Cuál es el nombre del grupo mercenario liderado por Guts antes de unirse a la Banda del Halcón?',
        respuestas: {
            a:'La Mano de Dios',
            b:'Los Caballeros Del Amanecer',
            c:'La Banda de los Halcones Negros'
        },
        respuestaCorrecta:'c'
    },//pregunta 3
    {
        pregunta:'¿Cuál es el nombre del antagonista principal en Berserk?',
        respuestas: {
            a:'Griffith',
            b:'Zodd',
            c:'Void'
        },
        respuestaCorrecta:'a'
    }
]
// logica de la pagina
const elementoPregunta = document.getElementById('pregunta');
const opcion1 = document.getElementById('op1');
const opcion2 = document.getElementById('op2');
const opcion3 = document.getElementById('op3');
const nextButton = document.getElementById('next');
const prevButton = document.getElementById('back');
const checkButton = document.getElementById('check');
const opciones = document.querySelectorAll('.respuesta')
const limiarBuffer = () => {
    elementoPregunta.innerHTML = '';
    opcion1.innerText = '';
    opcion2.innerText = '';
    opcion3.nnerText = '';
}
function mostrarPregunta  () {
    elementoPregunta.innerHTML = cuestionario[i].pregunta;
    opcion1.innerText = cuestionario[i].respuestas.a;
    opcion2.innerText = cuestionario[i].respuestas.b;
    opcion3.innerText = cuestionario[i].respuestas.c;
    opcion1.addEventListener('click', () => {
        selected = 'a';
        opcion1.style.backgroundImage = 'url(https://img.online-station.net/_content/2020/0623/167409/gallery/0601_640_480.jpg)';
        opcion1.style.backgroundPosition = 'center';
        opcion1.style.backgroundSize = 'cover';
        opcion1.style.transition = 'background-image 0.1s';
        opcion1.style.color = 'white';
        console.log(selected)
    });  
      opcion2.addEventListener('click', () => {
        selected = 'b';
        opcion2.style.backgroundImage = 'url(https://img.online-station.net/_content/2020/0623/167409/gallery/0601_640_480.jpg)';
        opcion2.style.backgroundPosition = 'center';
        opcion2.style.backgroundSize = 'cover';
        opcion2.style.transition = 'background-image 0.1s';
        opcion2.style.color = 'white';
    });  
      opcion3.addEventListener('click', () => {
        selected = 'c';
        opcion3.style.backgroundImage = 'url(https://img.online-station.net/_content/2020/0623/167409/gallery/0601_640_480.jpg)';
        opcion3.style.backgroundPosition = 'center';
        opcion3.style.backgroundSize = 'cover';
        opcion3.style.transition = 'background-image 0.1s';
        opcion3.style.color = 'white';
    });
}
function resetearEstiloOpciones() {
    opcion1.style.backgroundImage = ''; 
    opcion2.style.backgroundImage = '';
    opcion3.style.backgroundImage = '';
    selected = '';
    //resetear colores
    opcion1.style.color = 'black';
    opcion2.style.color = 'black';
    opcion3.style.color = 'black';

  }
let i = 0;
var selected = '';
let iMax = cuestionario.length;
window.onload = () => {
    limiarBuffer();
    // cargamos la primera pregunta y respuestas
    if ((elementoPregunta.innerHTML === '')){
        mostrarPregunta()

        nextButton.addEventListener('click', () => {
           if (i < iMax - 1){
            i++;
            //limiarBuffer();
            mostrarPregunta();
            resetearEstiloOpciones();
           }     
        })
        prevButton.addEventListener('click', () => {
            i--;
            limiarBuffer();
            mostrarPregunta();
            resetearEstiloOpciones();
        })
       checkButton.addEventListener('click', () =>{
            resetearEstiloOpciones()
            if(selected === ''){
                alert('Seleciona una respuesta porfavor');
            }else if (selected === cuestionario[i].respuestaCorrecta){
                alert('Correcto :D');
            }else {
                alert('Te equivocaste :(');
                resetearEstiloOpciones();
            }
       })
        
    }
}