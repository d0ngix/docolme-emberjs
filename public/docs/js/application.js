window.Docs = Ember.Application.create();

// Docs.ApplicationAdapter = DS.FixtureAdapter.extend();

var inflector = Ember.Inflector.inflector;
inflector.irregular('docs', 'docus');

Docs.ApplicationAdapter = DS.RESTAdapter.extend({
    host: 'http://localhost:8080'
});

Ember.Handlebars.helper('format-date', function (date) {
    // return moment(date).fromNow();
    return date;
});

var showdown = new Showdown.converter();
Ember.Handlebars.helper('format-markdown', function(input) {
    return new Handlebars.SafeString(showdown.makeHtml(input));
});