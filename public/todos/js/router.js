Todos.Router.map( function () {
    this.resource( 'todos', { path: '/' }, function () {
        this.route('active');
        this.route('completed');
    } );
} );

// Todos.TodosRoute = Ember.Route.extend({
//     model: function() {
//       return this.store.find('todo');
//     }
// });

Todos.TodosRoute = Ember.Route.extend({
    model: function() {
        return this.find('todos');
      }
  });

Todos.TodosIndexRoute = Ember.Route.extend({

    model: function(params) {
        return this.store.find('todo');
      }    
});

Todos.TodosActiveRoute = Ember.Route.extend({
    model: function () {
        return this.store.filter('todo', function (todo) {
            return !todo.get('isCompleted', 0);
        });
    },
    renderTemplate : function (controller) {
        this.render ('todos/index', {controller: controller})
    }
});

Todos.TodosCompletedRoute  = Ember.Route.extend({
    model: function () {
        return this.store.filter('todo', function (todo) {
            return todo.get('isCompleted',0);
        });
    },
    renderTemplate: function (controller) {
        this.render ('todos/index', {controller: controller})
    }
});

