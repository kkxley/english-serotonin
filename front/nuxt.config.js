const {resolve} = require('path'),
    frontRoot = resolve(__dirname);

module.exports = {
    server: {
        host: '0.0.0.0',
        port: 3001
    },
    css: [
        resolve(frontRoot, 'scss', 'main.scss')
    ],
    meta: [
        {
            name: 'viewport',
            content: 'width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1'
        },
    ],
    head: {
        link: [
            {rel: "preconnect", href: "https://fonts.googleapis.com"},
            {rel: "preconnect", href: "https://fonts.gstatic.com", crossOrigin: true},
            {
                href: "https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap",
                rel: "stylesheet"
            },
            {
                href: "https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap",
                rel: "stylesheet"
            }
        ]
    },
    static: {
        prefix: false
    },
    buildModules: [['@nuxtjs/dotenv', { path: './' }]],
}