window.App = window.App || {};
window.App.Promises = {
    when: function(valueOrPromise) {
            return Q.when(valueOrPromise);
    }
};
$.ajaxSetup({ cache: false });
window.App.Ajax = {
    request: function() {
            return window.App.Helpers.wrapJqueryPromise($.ajax.apply($.ajax,arguments));
    },
    extractError: function(err) {
        e = {};
        if (err.responseJSON) {
            e.message = err.responseJSON.errors;
            e.responseJSON = err.responseJSON;
        } else if (err.responseText) {
            e.message = err.responseText;
            e.responseText = err.responseText;
        } else
            e.message = err.statusText;
            e.code = err.statusCode;
           	return e;
    }
};
window.App.Helpers = {
    
    formatTimestamp: function(timestamp,format) {
        if (!format)
            format = 'LL';

        return moment(new Date(timestamp*1000)).format(format);
    },
    wrapJqueryPromise: function(promise) {
        var defer = Q.defer();
        promise
        .then(function(data) {   
            defer.resolve(data);
        }) .fail(function(response) {
            defer.reject(response);
        });
        return defer.promise;

    },
    extractQueryParameters: function() {
        this._queryParams = {};
        var self = this;
        location.search.substr(1).split("&").forEach(function(item) {
            var s = item.split("="),
            k = s[0],
            v = s[1] && decodeURIComponent(s[1]);
            (k in self._queryParams) ? self._queryParams[k].push(v) : self._queryParams[k] = [v]
        })
    },
    _queryParams: null,
    getQueryParameters: function() {
        if (!this._queryParams)
            this.extractQueryParameters();
        return this._queryParams;

    },
    getQueryParameter: function(k,firstValue) {
        if (!this._queryParams)
            this.extractQueryParameters();
        var v = this._queryParams[k];
        
        if (v && firstValue)
            return v[0];
        
        return v;
    }
};
