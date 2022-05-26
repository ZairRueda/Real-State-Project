/// <reference types="cypress" />

describe('Prueba del formulario de contacto', () => {

    it('Prueba la pagina de contacto y el envio de emails', () => {
        
        cy.visit('/contacto')

        cy.get('[data-cy="titulo-contacto"]').should('exist')

        cy.get('[data-cy="titulo-contacto"]').invoke('text').should('equal', 'Contacto')

        cy.get('[data-cy="titulo-contacto"]').invoke('text').should('not.equal', 'Formulario de Contacto')

        cy.get('[data-cy="enlace-enviar"]').click()

        cy.get('[data-cy="pagina-contacto"]').find('.alerta').find('.texto').invoke('text').should('equal', 'El mensaje no se pudo enviar, rellena todos los datos')

        cy.get('[data-cy="pagina-contacto"]').find('.alerta').find('.texto').invoke('text').should('not.equal', 'Mensaje Enviado Correctamente')

        cy.get('[data-cy="pagina-contacto"]').find('.alerta').find('.texto').invoke('text').should('equal', 'El mensaje no se pudo enviar, rellena todos los datos')

        cy.get('[data-cy="subTitulo-contacto"]').should('exist')
        
        cy.get('[data-cy="subTitulo-contacto"]').invoke('text').should('equal', 'Llene el Formulario de Contacto')

        cy.get('[data-cy="subTitulo-contacto"]').invoke('text').should('not.equal', 'Llene el formulario')
    })

    it('Llena los campos del formulario', () => {
        cy.get('[data-cy="input-nombre"]').type('Andres Jimenez')

        cy.get('[data-cy="input-mensaje"]').type('Este es un ejecicio de escritura')

        // Select
        cy.get('[data-cy="select-accion"]').select('Compra')

        cy.get('[data-cy="input-precio"]').type('300000')

        cy.get('[data-cy="forma-contacto"]').eq(0).check()
        cy.get('[data-cy="input-telefono"]').type('37728199192')
        cy.get('[data-cy="input-fecha"]').type('2021-09-20')
        cy.get('[data-cy="input-hora"]').type('08:20')
        
        // Para cambiar la seleccion
        cy.wait(3000)

        cy.get('[data-cy="forma-contacto"]').eq(1).check()

        cy.wait(3000)

        cy.get('[data-cy="input-email"]').type('correo@correo.com')

        cy.get('[data-cy="enlace-enviar"]').click()

        cy.get('[data-cy="pagina-contacto"]').find('.alerta').find('.texto').invoke('text').should('not.equal', 'El mensaje no se pudo enviar, rellena todos los datos')

        cy.get('[data-cy="pagina-contacto"]').find('.alerta').find('.texto').invoke('text').should('equal', 'Mensaje Enviado Correctamente')
    })

})