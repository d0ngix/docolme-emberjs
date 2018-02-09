Todos.EditTodoView = Ember.TextField.extend({
    didInsertElemennt : function () {
        this.$().focus();
    }
});

Ember.Handlebars.helper('edit-todo', Todos.EditTodoView);