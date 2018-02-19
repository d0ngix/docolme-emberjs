Docs.History = DS.Model.extend({
    doc_id : DS.attr('number'),
    fileName : DS.attr('string'),
    contentText : DS.attr('string'),
    created : DS.attr('date'),
    username : DS.attr('string') ,
    doc: DS.belongsTo('docs', { async: true })
    
});
//doc: DS.belongsTo('docs')   