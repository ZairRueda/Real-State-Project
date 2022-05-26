/// <reference types="cypress" />
// Para tener mejor autocompletado

describe('Carga la pagina principal', () => {
    it('Prueba el header de la pagina principal', () => {
        cy.visit('/')
        // Aun que se se le tiene que pasar una URL 
        // Esta forma de arriba nop es la correcta
        // Se definira en el cypress.json la url base

        // cy.get('h1')
        // Esto no es muy recomendable segun la documentacion de Cypress

        cy.get('[data-cy="heading-sitio"]').should('exist')
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal', 'Venta de Casas y Departamentos  Exclusivos de Lujo')
        // Para hacer algo con el archivo traido
        // Para eso usamos un exception, ejem un usuario existe o no existe
        // Es True o Falce
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('not.equal', 'bienes raices')

    })

    it('Prueba el heading de Sobre Nosotros', () => {
        cy.get('[data-cy="heading-nosotros"]').should('exist')
        // Verificacion de etiquetas correctas
        cy.get('[data-cy="heading-nosotros"]').should('have.prop', 'tagName').should('equal', 'H2')
        cy.get('[data-cy="heading-nosotros"]').invoke('text').should('equal', 'Más Sobre Nosotros' )

        // Textos
        cy.get('[data-cy="text-test"]').should('exist')

        // Iconos
        cy.get('[data-cy="iconos-nosotros"]').should('exist')

        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('have.length', 3)
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('not.length', 4)
        
    })

    it('Prueba la seccion de anuncios', () => {

        cy.get('[data-cy="seccion-anuncios"]').should('exist')

        // Imagenes
        cy.get('[data-cy="seccion-anuncios"]').find('.imagen-anuncio').should('exist')
        cy.get('[data-cy="seccion-anuncios"]').find('.imagen-anuncio').should('have.length', 3)

        // Precio
        cy.get('[data-cy="seccion-anuncios"]').find('.precio').should('have.length', 3)

        // Botones 
        cy.get('[data-cy="seccion-anuncios"]').find('.boton-amarillo-block').should('have.length', 3)

        // En el anuncio 
        cy.get('[data-cy="anuncio"]').should('have.length', 3)
        cy.get('[data-cy="anuncio"]').should('not.length', 5)

        // Enlace de las propiedades
        cy.get('[data-cy="enlace-propiedad"]').first().invoke('text').should('equal', 'Ver Propiedad' )
        cy.get('[data-cy="enlace-propiedad"]').should('have.class', 'boton-amarillo-block')
        cy.get('[data-cy="enlace-propiedad"]').should('not.class', 'boton-amarillo')
        
        // Provar el enlace a una propiedad
        cy.get('[data-cy="enlace-propiedad"]').first().click()
        cy.get('[data-cy="titulo-propiedad"]').should('exist')

        cy.wait(1000)
        cy.go('back')
        
    })

    it('Prueba el Routing hacia todas las propiedades', () => {

        cy.get('[data-cy="todas-propiedades"]').should('exist')   
        cy.get('[data-cy="todas-propiedades"]').should('have.class', 'boton-verde')

        // Comprovar el enlace
        cy.get('[data-cy="todas-propiedades"]').invoke('attr', 'href').should('equal', '/propiedades')
        cy.get('[data-cy="todas-propiedades"]').click()
        cy.get('[data-cy="titulo-propiedades-todas"]').should('exist')
        cy.get('[data-cy="titulo-propiedades-todas"]').invoke('text').should('equal', 'Casas y Depas en Venta' )

        cy.wait(1000)
        cy.go('back')

    })

    it('Probando la seccion de contacto y la pagina de contcato', () => {

        cy.get('[data-cy="seccion-contacto"]').should('exist')

        // Textos
        cy.get('[data-cy="seccion-contacto"]').find('h2').invoke('text').should('equal', 'Encuentra la casa de tus sueños')
        cy.get('[data-cy="seccion-contacto"]').find('p').invoke('text').should('equal', 'Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad')
        cy.get('[data-cy="seccion-contacto"]').find('a').invoke('text').should('equal', 'Contactános')

        // Boton y enlace
        cy.get('[data-cy="enlace-contacto"]').click()
        cy.get('[data-cy="titulo-contacto"]').invoke('text').should('equal', 'Contacto')

        // Otra forma de vicitar el enlace, en forma de promesa
        // cy.get('[data-cy="seccion-contacto"]').find('a').invoke('attr', 'href')
        // .then( href => {
        //     cy.visit(href)
        // })

        // Ya en la pagina
        // verificar la conprovacion de alerta de no envio
        
        
        cy.get('[data-cy="enlace-enviar"]').click()
        cy.get('[data-cy="pagina-contacto"]').find('.alerta').find('.texto').invoke('text').should('equal', 'El mensaje no se pudo enviar, rellena todos los datos')
        cy.get('[data-cy="pagina-contacto"]').find('.alerta').find('.texto').invoke('text').should('not.equal', 'Mensaje Enviado Correctamente')

        cy.wait(1000)
        cy.go('back')
        cy.go('back')


        // En caso de que se alla ingresado por medio de un promis
        // para regresar se utiliza
        // cy.visit('/');

    })

    it('Probando seccion de testimoniales y el Blog', () => {
        cy.get('[data-cy="seccion-blog"]').should('exist')

        // Blogs
        cy.get('[data-cy="seccion-blog"]').find('.blog').should('exist')
        cy.get('[data-cy="entrada-blog"]').find('.texto-entrada').find('a').find('h4').invoke('text').should('exist')
        cy.get('[data-cy="entrada-blog"]').find('.texto-entrada').find('a').invoke('attr', 'href')
        .then( href => {
            cy.visit(href)
        })

        cy.visit('/');
        
        // Testimoniales
        cy.get('[data-cy="seccion-blog"]').find('.testimoniales').should('exist')


    })

})