import Home from './views/Home';
import About from './views/About';
import ChannelCreate from './views/ChannelCreate';
import ChannelView from './views/ChannelView';
import ChannelPlay from './views/ChannelPlay';
import ChannelList from './views/ChannelList';
import ChannelConnect from './views/ChannelConnect';

//Vue.use(Router);

export default new VueRouter({
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/channel/create",
            name: "channel-create",
            component: ChannelCreate
        },
        {
            path: "/channel/:id/user/:userId",
            name: "channel-play",
            component: ChannelPlay
        },
        {
            path: "/channel/list",
            name: "channel-list",
            component: ChannelList
        },
        {
            path: "/channel/:id/connect",
            name: "channel-connect",
            component: ChannelConnect
        },
        {
            path: "/channel/:id/view",
            name: "channel-view",
            component: ChannelView
        },


    ]
});