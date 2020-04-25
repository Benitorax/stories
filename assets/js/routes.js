import Home from './views/Home';
import ChannelCreate from './views/ChannelCreate';
import ChannelView from './views/ChannelView';
import ChannelPlay from './views/ChannelPlay';

//Vue.use(Router);

export default new VueRouter({
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/channel/create",
            name: "channel-view",
            component: ChannelCreate
        },
        {
            path: "/channel/:id/user/:userId",
            name: "channel-play",
            component: ChannelPlay
        },
        {
            path: "/channel/:id",
            name: "channel-view",
            component: ChannelView
        },

    ]
});