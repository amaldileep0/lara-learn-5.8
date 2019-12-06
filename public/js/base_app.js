window.App = window.App || {};
window.App.Promises = {
    when: function(valueOrPromise) {
        return Q.when(valueOrPromise);
    }
};
$.ajaxSetup({
    cache: false
});
window.App.Ajax = {
    request: function() {
        return window.App.Helpers.wrapJqueryPromise($.ajax.apply($.ajax, arguments));
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

    formatTimestamp: function(timestamp, format) {
        if (!format)
            format = 'LL';

        return moment(new Date(timestamp * 1000)).format(format);
    },
    wrapJqueryPromise: function(promise) {
        var defer = Q.defer();
        promise
            .then(function(data) {
                defer.resolve(data);
            }).fail(function(response) {
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
            (k in self._queryParams) ? self._queryParams[k].push(v): self._queryParams[k] = [v]
        })
    },
    _queryParams: null,
    getQueryParameters: function() {
        if (!this._queryParams)
            this.extractQueryParameters();
        return this._queryParams;

    },
    getQueryParameter: function(k, firstValue) {
        if (!this._queryParams)
            this.extractQueryParameters();
        var v = this._queryParams[k];

        if (v && firstValue)
            return v[0];

        return v;
    }
};
window.App.Ui = {
    Modals: {
        loading: function(title, message) {
            var a = bootbox.dialog({
                title: title,
                message: message,
                closeButton: false,
                onEscape: function() {
                    return false;
                }
            });
            return {
                hide: function() {
                    $(a).modal('hide');
                },
                setTitle: function(text) {
                    $(a).find('.modal-title').html(text);
                },
                setMessage: function(text) {
                    $(a).find('.modal-body').html(text);
                }
            }

        },
        ajaxError: function(response) {
            return this.alert(window.App.Helpers.stripTags(response.responseText), response.statusText);
        },
        alert: function(message, title, cb, options) {
            if (_.isObject(cb)) {
                options = cb;
                cb = null;
            }
            var deferred = Q.defer();
            setTimeout(function() {
                bootbox.dialog({
                    message: message,
                    title: title,
                    onEscape: true,
                    buttons: {
                        success: {
                            label: 'OK',
                            className: 'btn-success',
                            callback: function() {
                                deferred.resolve('ok');
                                cb && cb('ok');
                            }
                        }
                    }
                });
            })
            return deferred.promise;
        },
        confirm: function(title, message, buttons, cb, options) {
            if (_.isFunction(buttons)) {
                options = cb;
                cb = buttons;
                buttons = null;

            }
            options = options || {};
            var deferred = Q.defer();
            var buttonLabels = ['OK', 'Cancel'];
            if (_.isArray(buttons) && !_.isEmpty(buttons) && _.isString(buttons[0])) {
                // buttons = array of labels
                buttonLabels = buttons;
                buttons = null;
            }
            if (!buttons) {
                buttons = {
                    success: {
                        label: buttonLabels[0],
                        className: 'btn-success',
                        callback: function() {
                            var r = cb && cb('ok');
                            if (r !== false) {
                                if (_.isObject(r))
                                    deferred.resolve(_.extend(r, {
                                        action: 'ok'
                                    }));
                                else
                                    deferred.resolve('ok');
                            }
                            return r;
                        }
                    },
                    main: {
                        label: buttonLabels[1],
                        className: 'btn-default',
                        callback: function() {
                            var r = cb && cb('cancel');
                            if (r !== false)
                                deferred.resolve('cancel');
                            return r;
                        }
                    }
                };
            } else {

            }

            bootbox.dialog({
                message: message,
                title: title,
                buttons: buttons,
                backdrop: options.backdrop
            });
            return deferred.promise;

        },
        confirmAndProgress: function(confirmTitle, confirmMessage, progressTitle, progressMessage, actionCb) {
            var self = this;
            var deferred = new Q.defer();
            setTimeout(function() {
                window.App.Ui.Modals.confirm(confirmTitle, confirmMessage,
                    function(result) {
                        if (result == 'ok') {
                            var a = window.App.Ui.Modals.loading(progressTitle, progressMessage);
                            actionCb()
                                .then(function(result) {
                                    deferred.resolve(result);
                                })
                                .fail(function(err) {
                                    deferred.reject(err);
                                })
                                .finally(function() {
                                    a.hide();
                                })
                        } else
                            deferred.resolve();

                    });
            });
            return deferred.promise;

        },
        prompt: function(title, message, cb, options) {
            options = options || {};
            var deferred = Q.defer();
            bootbox.prompt({
                message: message,
                title: title,
                callback: function(result) {
                    deferred.resolve(result);
                    cb && cb(result);
                },
                backdrop: options.backdrop
            });
            if (title == 'Change Password') {
                //Password masking for text field
                $(".bootbox-input").prop("type", "password");
            }
            return deferred.promise;

        }
    }
}