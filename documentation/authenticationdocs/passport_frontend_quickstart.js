// Passport ships with a JSON API that you may use to allow your users to create clients and personal access tokens

// To publish passport vue components
// php artisan vendor:publish --tag=passport-components

// once components have been published you should register them in your app.js

Vue.component(
   'passport-clients',
   require('./components/passport/Clients.vue').default
);

Vue.component(
   'passport-authorized-clients',
   require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
   'passport-personal-access-tokens',
   require('./components/passport/PersonalAccessTokens.vue').default
);

// run npm run dev to recompile assets
// <passport-clients></passport-clients>
// <passport-authorized-clients></passport-authorized-clients>
// <passport-personal-access-tokens></passport-personal-access-tokens>

// GET /oauth/clients
axios.get('/oauth/clients').then(response => {
   console.log(response.data)
});

// POST /oauth/clients
