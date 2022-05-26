En esta ocacion estaremos ocupando la herramienta Cypress para hacer el testing

npx cypress open : iniciador

Los archivos a probar se van guardando en la sub-carpeta de Cypress 
llamada :

> Integration

Por lo general llevan un .spec.js para demostrar que son testings

Funciones integradas

< describe() : 'Aqui se pine que hara el test'

< it() : 'sub-funcion de describe, que sirbe para hacer la prueba
cada it es una prueba en especifico

Por lo tanto un solo describe puede almacenar multiples pruebas 

Comandos
Todos los Comandos de Cypress comienzan con cy

> cy.visit('url') : este es uno de los comnados, toma la url a la que nos queremos dirigir
La URL principal se encuentra en el archivo cypress.json

> cy.get('codigo') : este es para traer un elemento de la pagina web 
Es recomendable traer por medio de un ('[data-cy="heading-sitio"]') arreglo parecido a CSS
esto para que sea un alemento unico ya que las clases y los IDs pueden ser compartidos

Integrados

> .should('exist') : se coloca despues de llamar la parte de codigo, y verifica que exista

> .invoke('text') : manda a traer el contenido del tipo que se le esta pasando 

> .should('equal', 'texto') : verifica que esa invoke , contenga el texto enviado en la parte de texto

> .should('not.equal', 'text') : lo contrario, que no sea igual

> .should('have.prop', 'tagName').should('equal', 'H1') : para comprovar que el troso de codigo 
contega la etiqueta o tagName

> .find('.nombreDeLaClase') : manda a llama a la clase seleccionada de el atributo adquirido, ejem, las subclases

> .should('have.length', 3) : verificar que el o los elementos dados tengan cierta extencion

> .should('not.length', 3) : verificar que el o los elementos dados no tengan cierta extencion

> .should('have.class', 'nombre de la clase') : verificar que conetnga la clase nesesaria

.first().click() : funcion cheinie, poner multiples metodos en el mismo selector

> .first() : seleccionar el primer elemento 

> .click() : dar un evento de click

> cy.wait(1000) : para darle un tiempo de espera despues de la ajecucion de algun comando 

> cy.go('back') : hacia donde nos dirigiremos al terminar el wait

> .invoke('attr') : traer los atributos y verificarlos

cy.get('[data-cy="seccion-contacto"]').find('a').invoke('attr', 'href').then( href => {
    cy.visit(href)
})
: Una forma de vicitar los enlaces

Cuando se esta iterando sobre enlaces, y se mandan llamar, estos vienen en forma de arreglo (vienen el conjunto),
aun que podemos celeccionar el primero, con .first, los demas ya no los podemos seleccionar

Para ello usaremos

> .eq() : este es un iterador con el cual se puede acceder a propiedades de un erreglo

Formulario 

> .type : para acceder a escribir en el input

En el un select

> .select('El elemento a seleccionar')

> .eq(No.elemento).check : para seleccionar el check necesario

Esto es lo que pertenese a la integracion

npx cypress 