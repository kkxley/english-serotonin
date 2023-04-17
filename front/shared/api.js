import axios from "axios";

const THEMES = 'themes/all';
const THEME = (path) => `themes/${path}`;
const SENTENCES_TYPES = 'sentences/types';
const SENTENCE = (theme, ids) => `sentences/${theme}?types=${ids}`;
const SENTENCES_CHECK = 'sentences/check';

class Api {

    constructor(baseUrl) {
        this.baseUrl = baseUrl
    }

    getTheme(path) {
        return this.get(THEME(path))
    }

    setCSRF(name, value) {
        this.csrf = name
        this.token = value
    }

    get(path) {
        return axios.get(`${this.baseUrl}${path}`)
            .then(({data}) => data);
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

    checkSentence ({sentence, words}) {
        return this.post(SENTENCES_CHECK, {sentence, words});
    }
}

//console.log(process.env.BASE_URL)
export default new Api('http://localhost:3005/api/')