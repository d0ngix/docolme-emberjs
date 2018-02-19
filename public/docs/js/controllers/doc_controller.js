Docs.DocController = Ember.ObjectController.extend({

    isEdit: false,

    actions: {
        edit: function() {
          this.set('isEdit', true);
        },
        doneEditting: function() {
            this.set('isEdit', false);
            this.get('model').save();
            this.transitionTo('docs');
        },
        cancel: function() {
            this.set('isEdit', false);            
        },

        removeDocs: function () {
          var doc = this.get('model');
          doc.deleteRecord();
          doc.save();
          this.transitionTo('docs')
        }
      },


    // isEditing: false,

    // isCompleted: function(key, value){
    //   var model = this.get('model');
  
    //   if (value === undefined) {
    //     // property being used as a getter
    //     return model.get('isCompleted');
    //   } else {
    //     // property being used as a setter
    //     model.set('isCompleted', value);
    //     model.save();
    //     return value;
    //   }
    // }.property('model.isCompleted')
  });