import _ from 'underscore';
import axios from 'axios';
const qs = require('qs');

export default function (endpoint) {
    const state = {
        all: []
    }

    const getters = {
        byId: state => (id) => {
            const data = _.find(state.all, (project) => {
                return project.id == id
            });
            return data || {};
        }
    }

    const mutations = {
        updateAll(state, data) {
            state.all = data;
        },
        merge(state, data) {
            state.all.push(data);
        }
    }

    const actions = {
        getAll(context, id) {
            let url = endpoint;
            if (id) {
                url += '?id=' + id;
            }
            console.log(url, id);
            return axios.get(url).then(res => {
                context.commit('updateAll', res.data);
            });
        },
        create(context, data) {
            data = qs.stringify(data);
            return axios.post(endpoint, data).then(res => {
                context.commit('merge', res.data);
            });
        }
    }

    return {
        state,
        getters,
        mutations,
        actions,
        namespaced: true
    }
}
