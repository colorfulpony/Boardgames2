import axios from 'axios'
import router from './router'
import Cookies from "js-cookie";


const api = axios.create()

const setCSRFToken = () => {
    return api.get("/csrf-cookie");
};

api.interceptors.request.use(
    (config) => {
        if (
            (config.method == "post" ||
                config.method == "put" ||
                config.method == "delete" ||
                config.method == "get") &&
            !Cookies.get("XSRF-TOKEN")
        ) {
            return setCSRFToken().then((response) => config);
        }
        return config;
    },
    (error) => {
        if (error.response.status == 401) {
            router.push({name: 'login'})
        }
        return Promise.reject(error);
    }
);

api.interceptors.response.use(
    (config) => {
        if (
            (config.method == "post" ||
                config.method == "put" ||
                config.method == "delete" ||
                config.method == "get") &&
            !Cookies.get("XSRF-TOKEN")
        ) {
            return setCSRFToken().then((response) => config);
        }
        return config;
    },
    (error) => {
        if (error.response.status == 401) {
            router.push({name: 'login'})
        }
        return Promise.reject(error);
    }
);

export default api
