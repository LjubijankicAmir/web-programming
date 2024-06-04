var Constants = {
    //API_BASE_URL: 'http://localhost/project/backend/',
    get_api_base_url: function () {
        if(location.hostname === 'localhost'){
            return 'http://localhost/project/backend/';
        } else {
            return 'https://urchin-app-a78me.ondigitalocean.app/backend/';
        }
    },
    IMAGE_URL: 'https://urchin-app-a78me.ondigitalocean.app/assets/images/',
}