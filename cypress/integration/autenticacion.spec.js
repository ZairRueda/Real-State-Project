/// <reference types="cypress" />

describe('Probar la autenticacion', () => {
    it('Prueba la autenticacion en /login', () => {
        cy.visit('/login')

        cy.get('[data-cy="title-login"]').should('exist')
        cy.get('[data-cy="title-login"]').should('have.text', 'Iniciar Sesion')

        cy.get('[data-cy="type-email"]').should('exist')

        // Compribar que funciona la autenticacion
        cy.get('[data-cy="type-email"]').type('correo@correo.com')

        cy.get('[data-cy="type-password"]').should('exist')

        cy.get('[data-cy="type-password"]').type('1234567')

        cy.get('[data-cy="boton-login"]').should('exist')

        cy.get('[data-cy="boton-login"]').click()

        cy.get('[data-cy="pagina-login"]').find('.alerta').should('exist')

        cy.get('[data-cy="texto-error"]').should('exist')

        cy.wait(3000)

        // cy.visit('/login')

    })


})