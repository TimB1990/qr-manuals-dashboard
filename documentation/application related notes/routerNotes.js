// import VueRouter from "vue-router"

/* react to params*/
const User = {
    template: '...',
    watch: {
        $route(to, from) {
            // react to route changes
        }
    }
}

/* before route update */
const User = {
    template: '...',
    beforeRouteUpdate(to, from, next) {
        // react to route changes
        // don't forget to call next();
    }
}

/* BASIC 404 in ROUTER.JS*/

{
    // will match everything
    path: '*'
}
{
    // will match everything starting with '/user-'
    path: '/user-*'
}

// Given a route {path: '/user'} in component
// when given a * a param named pathMatch is automatically added to $route.params, it contains the rest of the url matched by the *

this.$router.push('/user-admin')
this.$route.params.pathMatch // 'admin'

// nested routes
const User = {
    template: `<div class='user'><h2>User {{$route.params.id }}</h2><router-view></router-view></div>`
}

// in routes.js
const router = new VueRouter({
    routes: [
        {
            path: '/user/:id', component: User,
            children: [{
                // Userprofile will be rendered inside User's <router-view>
                // when /user/:id/profile is matched
                path: 'profile',
                component: UserProfile
            }, {
                // UserPosts will be rendered inside User's <router-view>
                // when /user/:id/posts is matched
                path: 'posts',
                component: UserPosts
            }]
        }
    ]
});

// empty subroute path, , when you visit /user/foo, nothing will be rendered inside User's outlet, because no sub route is matched

const router = new VueRouter({
    routes: [
        {
            path: '/user/:id', component: User,
            children: [
                // UserHome will be rendered inside User's <router-view>
                // when /user/:id is matched
                { path: '', component: UserHome },
            ]
        }
    ]
})

// literal string path (router.push equavent to <router-link :to="...">)
router.push('home')

// object
router.push({ path: 'home' })

// named route
router.push({ name: 'user', params: { userId: '123' } })

// with query, resulting in /register?plan=private
router.push({ path: 'register', query: { plan: 'private' } })

const userId = '123'
router.push({ name: 'user', params: { userId } }) // -> /user/123
router.push({ path: `/user/${userId}` }) // -> /user/123
// This will NOT work
router.push({ path: '/user', params: { userId } }) // -> /user

// Named view to display multiple at same time, instead of nesting them
`<router-view class="view one"></router-view>
<router-view class="view two" name="a"></router-view>
<router-view class="view three" name="b"></router-view>`

const router = new VueRouter({
    routes: [
        {
            path: '/',
            components: {
                default: Foo,
                a: Bar,
                b: Baz
            }
        }
    ]
})

// nested named views
`
/settings/emails                                       /settings/profile
+-----------------------------------+                  +------------------------------+
| UserSettings                      |                  | UserSettings                 |
| +-----+-------------------------+ |                  | +-----+--------------------+ |
| | Nav | UserEmailsSubscriptions | |  +------------>  | | Nav | UserProfile        | |
| |     +-------------------------+ |                  | |     +--------------------+ |
| |     |                         | |                  | |     | UserProfilePreview | |
| +-----+-------------------------+ |                  | +-----+--------------------+ |
+-----------------------------------+                  +------------------------------+
`
// notes:
// Nav is just a regular component
// UserSettings is the view component
// UserEmailsSubscriptions, UserProfile, UserProfilePreview are nested view components

// layout of UserSettings.vue
`
<div>
<h1>User Settings</h1>
<NavBar/>
<router-view/>
<router-view name="helper"/>
</div>
`

// route configuration
const Router = new VueRouter({
    routes: [
        {
            path: '/settings',
            // the view component
            component: UserSettings,
            // the child view components
            children: [
                // path 'emails' has one component
                { path: 'emails', 
                component: UserEmailsSubscriptions
            },
                // path profile has two components
                { path: 'profile', 
                components:{
                    default: UserProfile,
                    helper: UserProfilePreview
                }}
            ]
        }
    ]
})

// REDIRECT AND ALIAS
const router = new VueRouter({
    routes: [
        { path: '/a', redirect: '/b'}
    ]
})

const router = new VueRouter({
    routes: [
        { path: '/a', redirect: { name: 'foo' }}
    ]
})

// dynamic redirecting
const router = new VueRouter({
    routes: [
        {
            path: '/a',
            redirect: to => {
                // function receives the target route as argument
                // return redirect path/location here.
            }
        }
    ]
})

/*
An alias gives you the freedom to map a UI structure to an arbitrary URL, instead of being constrained by the configuration's nesting structure.
*/

const router = new VueRouter({
    routes: [
        {
            path: '/a',
            component: AliasBcomponent,
            alias: '/b'
        }
    ]
})

// passing props to route components
const User = {
    props: ['id'],
    template: '<div>User{{ $route.params.id }}</div>'
}

const router = new VueRouter({
    routes: [
        {
            path: '/user/:id', component: User, props: true
        },
        // for routes with named views you have to define the props option for each named view
        {
            path: '/user/:id',
            components: { 
                default: User, 
                sidebar: Sidebar 
            },
            props: { 
                default: true, 
                sidebar: false 
            }
        }
    ]
})

// object mode
const router = new VueRouter({
    routes: [
        {
            path: '/promotion/from-newsletter', 
            component: Promotion, 
            props: {
                newsletterPopup: false
            }
        }
    ]
})

// function mode to create function that returns props. This allows you to cast parameters in other types
// combine static static values with route-based values, etc.

// the urls /search?q=vue would pass {query: 'vue'} as props to the SearchUser component.
const router = new VueRouter({
    routes: [
        {
            path: '/search',
            component: SearchUser,
            props: (route) => ({ query: route.query.q})
        }
    ]
})

// NAVIGATION GUARDS -- in router.js
// next => move to next hook in the pipeline (for middleware)

const router = new VueRouter({
    //
})

// always use if/else
router.beforeEach((to, from, next) => {
    if(to.name !== 'login' && !isAuthenticated){
        next({ name: 'login' })
    }
    else next();

    // or other functionalitiy
})

// router.beforeResolve calls resolve guards just before navigation is confirmed, after all in-component guards and async route components are resolved

// PER-ROUTE GUARD
const router = new VueRouter({
    path: '/foo',
    component: Foo,
    beforeEnter: (to, from, next) => {
        // ...
    }
})

// ROUTE META FIELDS

const router = new VueRouter({
    routes: [
        {
            path: '/foo',
            component: Foo,
            children: [
                {
                    path: 'bar',
                    component: Bar,
                    meta: {requiresAuth: true}
                }
            ]
        }
    ]
})

router.beforeEach((to,from,next) => {
    if (to.matched.some(record => record.meta.requiresAuth)){
        // this route requires auth, if not redirect to login page
        if(!auth.loggedin()){
            next({path:'/login', query: {redirect: to.fullPath}})
        }
        else{
            next()
        }
    }
    else{
        next() //make sure you allways call next
    }
})





