import axios from "axios";

const THEMES = 'themes/all';
const THEME = (path) => `themes/${path}`;
const SENTENCES_TYPES = 'sentences/types';
const SENTENCE = (theme, ids) => `sentences/${theme}?types=${ids}`;
const SENTENCES_CHECK = 'sentences/check';

const SENTENCES = (theme) => `sentences?themePath=${theme}`;
const SENTENCES_ADD = 'sentences/add';

class BaseApi {

    constructor(baseUrl) {
        this.baseUrl = baseUrl
    }

    setCSRF(name, value) {
        this.csrf = name
        this.token = value
    }

    get(path) {
        return axios.get(`${this.baseUrl}${path}`)
            .then(({data}) => data);
    }

    post(path, data) {
        const formData = new FormData();

        for (const [key, value] of Object.entries(data)) {
            formData.append(key, value);
        }

        if (this.csrf && this.token) {
            formData.append(this.csrf, this.token);
        }

        return axios.post(`${this.baseUrl}${path}`, formData)
            .then(({data}) => data);
    }
}

class Api extends BaseApi {

    getTheme(path) {
        return this.get(THEME(path))
    }

    getThemes() {
        return this.get(THEMES);
    }

    getSentencesTypes() {
        return this.get(SENTENCES_TYPES)
    }

    getSentence(theme, typesId) {
        return this.get(SENTENCE(theme, typesId.join(',')))
    }

    checkSentence({sentence, words}) {
        return this.post(SENTENCES_CHECK, {sentence, words});
    }
}

class AdminApi extends BaseApi {
    constructor(baseUrl, baseApi) {
        super(baseUrl);
        this.api = baseApi
    }

    getThemes() {
        return this.api.getThemes();
    }

    getSentences(theme) {
        return this.get(SENTENCES(theme))
    }

    addSentences(theme, type, russian, english) {
        return this.post(SENTENCES_ADD, {
            theme, type, russian, english
        })
    }

    getSentencesTypes() {
        return this.api.getSentencesTypes()
    }
}

const api = new Api('http://localhost:3005/api/')

//console.log(process.env.BASE_URL)
export default api
export const adminApi = new AdminApi('http://localhost:3005/api/admin/', api)