define([
    'jquery',
    'uiComponent',
    'ko'
], function ($, Component, ko) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Christian_NttdataPacient/test',
            message: '',
            pacientes: ko.observableArray([]),
            isTableVisible: ko.observable(false),
            newPaciente: {
                NIF: ko.observable(''),
                nombre: ko.observable(''),
                apellidos: ko.observable(''),
                telefono: ko.observable(''),
                correo: ko.observable(''),
                localidad: ko.observable('')
            }
        },

        initialize: function (config) {
            this._super();
            this.message = config.message;
            try {
                this.pacientes = ko.observableArray(config.pacientes ? config.pacientes : []);
            } catch (e) {
                console.error('Error parsing pacientes JSON:', e);
                this.pacientes = ko.observableArray();
            }
        },
        removePaciente: function (paciente) {
            if (paciente) {
                this.pacientes.remove(paciente);
            } else {
                console.error('El objeto paciente es undefined');
            }
        },
        toggleTableVisibility: function() {
            this.isTableVisible(!this.isTableVisible()); // Alternar la visibilidad de la tabla
        },
        addPaciente: function() {
            var newPaciente = {
                NIF: this.newPaciente.NIF(),
                nombre: this.newPaciente.nombre(),
                apellidos: this.newPaciente.apellidos(),
                telefono: this.newPaciente.telefono(),
                correo: this.newPaciente.correo(),
                localidad: this.newPaciente.localidad()
            };
            var self = this;
            $.ajax({
                url: '/nttdatapacient/ajax/save',
                type: 'POST',
                data: newPaciente,
                success: function(response) {
                    if (response.success) {
                        self.pacientes.push(newPaciente);

                        // Limpiar campos del formulario
                        self.newPaciente.NIF('');
                        self.newPaciente.nombre('');
                        self.newPaciente.apellidos('');
                        self.newPaciente.telefono('');
                        self.newPaciente.correo('');
                        self.newPaciente.localidad('');

                        alert('Paciente añadido correctamente');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ha ocurrido un error: ' + error);
                }
            });
        }
    });
});
