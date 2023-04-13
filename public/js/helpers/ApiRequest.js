async function sendRequest(url, method, data = {}, headerOverrides = {}) {
    return axios.request({
        method: method,
        url: url,
        data: data,
        headers: {
            ...headerOverrides
        }
    });
}
