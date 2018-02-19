Docs.Docs = DS.Model.extend({
    fileName : DS.attr('string'),
    contentText : DS.attr('string'),
    created : DS.attr('date'),
    userId : DS.attr('number'),
    histories : DS.attr()
    //histories : DS.hasMany('history', { async: true })
});

// Docs.Doc.FIXTURES = [
//     {
//       id: 1,
//       fileName: 'Learn Ember.js 1',
//       content: 'This is  the day that the LORD has made. We will rejoice and be glad in it.',
//       userId : 1,
//       created : new Date('2018-02-08T21:55:45')

//     },
//     {
//         id: 2,
//         fileName: 'Learn Angular.js 2',
//         content: 'The quick brown fox jumps over the laz dog over my head near the riverbank. The quick brown fox jumps over the laz dog over my head near the riverbank. The quick brown fox jumps over the laz dog over my head near the riverbank. ',
//         userId : 1,
//         created : new Date('2018-02-08T21:55:45')
//     },
//     {
//         id: 3,
//         fileName: 'Learn React.js 3',
//         content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
//         userId : 2,
//         created : new Date('2018-02-08T21:55:45')
//     }
// ];