! function () {
    var t, e, n;
    ! function (i) {
        function r(t, e) {
            return b.call(t, e)
        }

        function o(t, e) {
            var n, i, r, o, s, a, u, l, c, f, d, h, p = e && e.split("/"),
                g = y.map,
                m = g && g["*"] || {};
            if (t) {
                for (t = t.split("/"), s = t.length - 1, y.nodeIdCompat && w.test(t[s]) && (t[s] = t[s].replace(w, "")), "." === t[0].charAt(0) && p && (h = p.slice(0, p.length - 1), t = h.concat(t)), c = 0; c < t.length; c++)
                    if (d = t[c], "." === d) t.splice(c, 1), c -= 1;
                    else if (".." === d) {
                        if (0 === c || 1 === c && ".." === t[2] || ".." === t[c - 1]) continue;
                        c > 0 && (t.splice(c - 1, 2), c -= 2)
                    }
                t = t.join("/")
            }
            if ((p || m) && g) {
                for (n = t.split("/"), c = n.length; c > 0; c -= 1) {
                    if (i = n.slice(0, c).join("/"), p)
                        for (f = p.length; f > 0; f -= 1)
                            if (r = g[p.slice(0, f).join("/")], r && (r = r[i])) {
                                o = r, a = c;
                                break
                            }
                    if (o) break;
                    !u && m && m[i] && (u = m[i], l = c)
                } !o && u && (o = u, a = l), o && (n.splice(0, a, o), t = n.join("/"))
            }
            return t
        }

        function s(t, e) {
            return function () {
                var n = x.call(arguments, 0);
                return "string" != typeof n[0] && 1 === n.length && n.push(null), h.apply(i, n.concat([t, e]))
            }
        }

        function a(t) {
            return function (e) {
                return o(e, t)
            }
        }

        function u(t) {
            return function (e) {
                m[t] = e
            }
        }

        function l(t) {
            if (r(v, t)) {
                var e = v[t];
                delete v[t], _[t] = !0, d.apply(i, e)
            }
            if (!r(m, t) && !r(_, t)) throw new Error("No " + t);
            return m[t]
        }

        function c(t) {
            var e, n = t ? t.indexOf("!") : -1;
            return n > -1 && (e = t.substring(0, n), t = t.substring(n + 1, t.length)), [e, t]
        }

        function f(t) {
            return function () {
                return y && y.config && y.config[t] || {}
            }
        }
        var d, h, p, g, m = {},
            v = {},
            y = {},
            _ = {},
            b = Object.prototype.hasOwnProperty,
            x = [].slice,
            w = /\.js$/;
        p = function (t, e) {
            var n, i = c(t),
                r = i[0];
            return t = i[1], r && (r = o(r, e), n = l(r)), r ? t = n && n.normalize ? n.normalize(t, a(e)) : o(t, e) : (t = o(t, e), i = c(t), r = i[0], t = i[1], r && (n = l(r))), {
                f: r ? r + "!" + t : t,
                n: t,
                pr: r,
                p: n
            }
        }, g = {
            require: function (t) {
                return s(t)
            },
            exports: function (t) {
                var e = m[t];
                return "undefined" != typeof e ? e : m[t] = {}
            },
            module: function (t) {
                return {
                    id: t,
                    uri: "",
                    exports: m[t],
                    config: f(t)
                }
            }
        }, d = function (t, e, n, o) {
            var a, c, f, d, h, y, b = [],
                x = typeof n;
            if (o = o || t, "undefined" === x || "function" === x) {
                for (e = !e.length && n.length ? ["require", "exports", "module"] : e, h = 0; h < e.length; h += 1)
                    if (d = p(e[h], o), c = d.f, "require" === c) b[h] = g.require(t);
                    else if ("exports" === c) b[h] = g.exports(t), y = !0;
                    else if ("module" === c) a = b[h] = g.module(t);
                    else if (r(m, c) || r(v, c) || r(_, c)) b[h] = l(c);
                    else {
                        if (!d.p) throw new Error(t + " missing " + c);
                        d.p.load(d.n, s(o, !0), u(c), {}), b[h] = m[c]
                    }
                f = n ? n.apply(m[t], b) : void 0, t && (a && a.exports !== i && a.exports !== m[t] ? m[t] = a.exports : f === i && y || (m[t] = f))
            } else t && (m[t] = n)
        }, t = e = h = function (t, e, n, r, o) {
            if ("string" == typeof t) return g[t] ? g[t](e) : l(p(t, e).f);
            if (!t.splice) {
                if (y = t, y.deps && h(y.deps, y.callback), !e) return;
                e.splice ? (t = e, e = n, n = null) : t = i
            }
            return e = e || function () { }, "function" == typeof n && (n = r, r = o), r ? d(i, t, e, n) : setTimeout(function () {
                d(i, t, e, n)
            }, 4), h
        }, h.config = function (t) {
            return h(t)
        }, t._defined = m, n = function (t, e, n) {
            if ("string" != typeof t) throw new Error("See almond README: incorrect module build, no module name");
            e.splice || (n = e, e = []), r(m, t) || r(v, t) || (v[t] = [t, e, n])
        }, n.amd = {
            jQuery: !0
        }
    }(), n("bower_components/almond/almond", function () { }), n("jquery", [], function () {
        "use strict";
        return jQuery
    }), n("underscore", [], function () {
        "use strict";
        return _
    }),
        function (t, e) {
            "object" == typeof exports && "object" == typeof module ? module.exports = e() : "function" == typeof n && n.amd ? n("stampit", e) : "object" == typeof exports ? exports.stampit = e() : t.stampit = e()
        }(this, function () {
            return function (t) {
                function e(i) {
                    if (n[i]) return n[i].exports;
                    var r = n[i] = {
                        exports: {},
                        id: i,
                        loaded: !1
                    };
                    return t[i].call(r.exports, r, r.exports, e), r.loaded = !0, r.exports
                }
                var n = {};
                return e.m = t, e.c = n, e.p = "", e(0)
            }([function (t, e, n) {
                "use strict";

                function i(t) {
                    return t && t.__esModule ? t : {
                        "default": t
                    }
                }

                function r(t) {
                    return t && _["default"](t.then)
                }

                function o() {
                    for (var t = [], e = arguments.length, n = Array(e), i = 0; e > i; i++) n[i] = arguments[i];
                    return _["default"](n[0]) ? v["default"](n, function (e) {
                        _["default"](e) && t.push(e)
                    }) : x["default"](n[0]) && v["default"](n, function (e) {
                        v["default"](e, function (e) {
                            _["default"](e) && t.push(e)
                        })
                    }), t
                }

                function s(t) {
                    for (var e = arguments.length, n = Array(e > 1 ? e - 1 : 0), i = 1; e > i; i++) n[i - 1] = arguments[i];
                    return w.mixinFunctions.apply(void 0, [t.methods].concat(n))
                }

                function a(t) {
                    for (var e = arguments.length, n = Array(e > 1 ? e - 1 : 0), i = 1; e > i; i++) n[i - 1] = arguments[i];
                    return t.refs = t.state = w.mixin.apply(void 0, [t.refs].concat(n)), t.refs
                }

                function u(t) {
                    for (var e = arguments.length, n = Array(e > 1 ? e - 1 : 0), i = 1; e > i; i++) n[i - 1] = arguments[i];
                    var r = o.apply(void 0, n);
                    return t.init = t.enclose = t.init.concat(r), t.init
                }

                function l(t) {
                    for (var e = arguments.length, n = Array(e > 1 ? e - 1 : 0), i = 1; e > i; i++) n[i - 1] = arguments[i];
                    return w.merge.apply(void 0, [t.props].concat(n))
                }

                function c(t) {
                    for (var e = arguments.length, n = Array(e > 1 ? e - 1 : 0), i = 1; e > i; i++) n[i - 1] = arguments[i];
                    return w.mixin.apply(void 0, [t["static"]].concat(n))
                }

                function f(t, e) {
                    for (var n = C(t), i = arguments.length, r = Array(i > 2 ? i - 2 : 0), o = 2; i > o; o++) r[o - 2] = arguments[o];
                    return e.apply(void 0, [n.fixed].concat(r)), n
                }

                function d() {
                    for (var t = C(), e = arguments.length, n = Array(e), i = 0; e > i; i++) n[i] = arguments[i];
                    return v["default"](n, function (e) {
                        e && e.fixed && (s(t.fixed, e.fixed.methods), a(t.fixed, e.fixed.refs || e.fixed.state), u(t.fixed, e.fixed.init || e.fixed.enclose), l(t.fixed, e.fixed.props), c(t.fixed, e.fixed["static"]))
                    }), w.mixin(t, t.fixed["static"])
                }

                function h(t) {
                    return _["default"](t) && _["default"](t.methods) && (_["default"](t.refs) || _["default"](t.state)) && (_["default"](t.init) || _["default"](t.enclose)) && _["default"](t.props) && _["default"](t["static"]) && x["default"](t.fixed)
                }

                function p(t) {
                    var e = C();
                    return e.fixed.refs = e.fixed.state = w.mergeChainNonFunctions(e.fixed.refs, t.prototype), w.mixin(e, w.mixin(e.fixed["static"], t)), w.mixinChainFunctions(e.fixed.methods, t.prototype), u(e.fixed, function (e) {
                        var n = e.instance,
                            i = e.args;
                        return t.apply(n, i)
                    }), e
                }

                function g(t) {
                    for (var e = C(), n = arguments.length, i = Array(n > 1 ? n - 1 : 0), r = 1; n > r; r++) i[r - 1] = arguments[r];
                    return t.apply(void 0, [e.fixed].concat(i)), e
                }
                Object.defineProperty(e, "__esModule", {
                    value: !0
                });
                var m = n(1),
                    v = i(m),
                    y = n(12),
                    _ = i(y),
                    b = n(8),
                    x = i(b),
                    w = n(27),
                    j = Object.create,
                    C = function (t) {
                        var e = {
                            methods: {},
                            refs: {},
                            init: [],
                            props: {},
                            "static": {}
                        };
                        e.state = e.refs, e.enclose = e.init, t && (s(e, t.methods), a(e, t.refs), u(e, t.init), l(e, t.props), c(e, t["static"]));
                        var n = function (t) {
                            for (var i = arguments.length, o = Array(i > 1 ? i - 1 : 0), s = 1; i > s; s++) o[s - 1] = arguments[s];
                            var a = w.mixin(j(e.methods), e.refs, t);
                            w.mergeUnique(a, e.props);
                            var u = null;
                            return e.init.length > 0 && v["default"](e.init, function (t) {
                                if (_["default"](t))
                                    if (u) u = u.then(function (e) {
                                        a = e || a;
                                        var i = t.call(a, {
                                            args: o,
                                            instance: a,
                                            stamp: n
                                        });
                                        return i ? r(i) ? i : a = i : a
                                    });
                                    else {
                                        var e = t.call(a, {
                                            args: o,
                                            instance: a,
                                            stamp: n
                                        });
                                        if (!e) return;
                                        if (!r(e)) return void (a = e);
                                        u = e
                                    }
                            }), u ? u.then(function (t) {
                                return t || a
                            }) : a
                        },
                            i = f.bind(null, e, a),
                            o = f.bind(null, e, u);
                        return w.mixin(n, {
                            create: n,
                            fixed: e,
                            methods: f.bind(null, e, s),
                            refs: i,
                            state: i,
                            init: o,
                            enclose: o,
                            props: f.bind(null, e, l),
                            "static": function () {
                                for (var t = arguments.length, e = Array(t), i = 0; t > i; i++) e[i] = arguments[i];
                                var r = f.apply(void 0, [n.fixed, c].concat(e));
                                return w.mixin(r, r.fixed["static"])
                            },
                            compose: function () {
                                for (var t = arguments.length, e = Array(t), i = 0; t > i; i++) e[i] = arguments[i];
                                return d.apply(void 0, [n].concat(e))
                            }
                        }, e["static"])
                    };
                e["default"] = w.mixin(C, {
                    methods: g.bind(null, s),
                    refs: g.bind(null, a),
                    init: g.bind(null, u),
                    props: g.bind(null, l),
                    "static": function () {
                        for (var t = arguments.length, e = Array(t), n = 0; t > n; n++) e[n] = arguments[n];
                        var i = g.apply(void 0, [c].concat(e));
                        return w.mixin(i, i.fixed["static"])
                    },
                    compose: d,
                    mixin: w.mixin,
                    extend: w.mixin,
                    mixIn: w.mixin,
                    assign: w.mixin,
                    isStamp: h,
                    convertConstructor: p
                }), t.exports = e["default"]
            }, function (t, e, n) {
                var i = n(2),
                    r = n(3),
                    o = n(24),
                    s = o(i, r);
                t.exports = s
            }, function (t, e) {
                function n(t, e) {
                    for (var n = -1, i = t.length; ++n < i && e(t[n], n, t) !== !1;);
                    return t
                }
                t.exports = n
            }, function (t, e, n) {
                var i = n(4),
                    r = n(23),
                    o = r(i);
                t.exports = o
            }, function (t, e, n) {
                function i(t, e) {
                    return r(t, e, o)
                }
                var r = n(5),
                    o = n(9);
                t.exports = i
            }, function (t, e, n) {
                var i = n(6),
                    r = i();
                t.exports = r
            }, function (t, e, n) {
                function i(t) {
                    return function (e, n, i) {
                        for (var o = r(e), s = i(e), a = s.length, u = t ? a : -1; t ? u-- : ++u < a;) {
                            var l = s[u];
                            if (n(o[l], l, o) === !1) break
                        }
                        return e
                    }
                }
                var r = n(7);
                t.exports = i
            }, function (t, e, n) {
                function i(t) {
                    return r(t) ? t : Object(t)
                }
                var r = n(8);
                t.exports = i
            }, function (t, e) {
                function n(t) {
                    var e = typeof t;
                    return !!t && ("object" == e || "function" == e)
                }
                t.exports = n
            }, function (t, e, n) {
                var i = n(10),
                    r = n(14),
                    o = n(8),
                    s = n(18),
                    a = i(Object, "keys"),
                    u = a ? function (t) {
                        var e = null == t ? void 0 : t.constructor;
                        return "function" == typeof e && e.prototype === t || "function" != typeof t && r(t) ? s(t) : o(t) ? a(t) : []
                    } : s;
                t.exports = u
            }, function (t, e, n) {
                function i(t, e) {
                    var n = null == t ? void 0 : t[e];
                    return r(n) ? n : void 0
                }
                var r = n(11);
                t.exports = i
            }, function (t, e, n) {
                function i(t) {
                    return null == t ? !1 : r(t) ? c.test(u.call(t)) : o(t) && s.test(t)
                }
                var r = n(12),
                    o = n(13),
                    s = /^\[object .+?Constructor\]$/,
                    a = Object.prototype,
                    u = Function.prototype.toString,
                    l = a.hasOwnProperty,
                    c = RegExp("^" + u.call(l).replace(/[\\^$.*+?()[\]{}|]/g, "\\$&").replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g, "$1.*?") + "$");
                t.exports = i
            }, function (t, e, n) {
                function i(t) {
                    return r(t) && a.call(t) == o
                }
                var r = n(8),
                    o = "[object Function]",
                    s = Object.prototype,
                    a = s.toString;
                t.exports = i
            }, function (t, e) {
                function n(t) {
                    return !!t && "object" == typeof t
                }
                t.exports = n
            }, function (t, e, n) {
                function i(t) {
                    return null != t && o(r(t))
                }
                var r = n(15),
                    o = n(17);
                t.exports = i
            }, function (t, e, n) {
                var i = n(16),
                    r = i("length");
                t.exports = r
            }, function (t, e) {
                function n(t) {
                    return function (e) {
                        return null == e ? void 0 : e[t]
                    }
                }
                t.exports = n
            }, function (t, e) {
                function n(t) {
                    return "number" == typeof t && t > -1 && t % 1 == 0 && i >= t
                }
                var i = 9007199254740991;
                t.exports = n
            }, function (t, e, n) {
                function i(t) {
                    for (var e = u(t), n = e.length, i = n && t.length, l = !!i && a(i) && (o(t) || r(t)), f = -1, d = []; ++f < n;) {
                        var h = e[f];
                        (l && s(h, i) || c.call(t, h)) && d.push(h)
                    }
                    return d
                }
                var r = n(19),
                    o = n(20),
                    s = n(21),
                    a = n(17),
                    u = n(22),
                    l = Object.prototype,
                    c = l.hasOwnProperty;
                t.exports = i
            }, function (t, e, n) {
                function i(t) {
                    return o(t) && r(t) && a.call(t, "callee") && !u.call(t, "callee")
                }
                var r = n(14),
                    o = n(13),
                    s = Object.prototype,
                    a = s.hasOwnProperty,
                    u = s.propertyIsEnumerable;
                t.exports = i
            }, function (t, e, n) {
                var i = n(10),
                    r = n(17),
                    o = n(13),
                    s = "[object Array]",
                    a = Object.prototype,
                    u = a.toString,
                    l = i(Array, "isArray"),
                    c = l || function (t) {
                        return o(t) && r(t.length) && u.call(t) == s
                    };
                t.exports = c
            }, function (t, e) {
                function n(t, e) {
                    return t = "number" == typeof t || i.test(t) ? +t : -1, e = null == e ? r : e, t > -1 && t % 1 == 0 && e > t
                }
                var i = /^\d+$/,
                    r = 9007199254740991;
                t.exports = n
            }, function (t, e, n) {
                function i(t) {
                    if (null == t) return [];
                    u(t) || (t = Object(t));
                    var e = t.length;
                    e = e && a(e) && (o(t) || r(t)) && e || 0;
                    for (var n = t.constructor, i = -1, l = "function" == typeof n && n.prototype === t, f = Array(e), d = e > 0; ++i < e;) f[i] = i + "";
                    for (var h in t) d && s(h, e) || "constructor" == h && (l || !c.call(t, h)) || f.push(h);
                    return f
                }
                var r = n(19),
                    o = n(20),
                    s = n(21),
                    a = n(17),
                    u = n(8),
                    l = Object.prototype,
                    c = l.hasOwnProperty;
                t.exports = i
            }, function (t, e, n) {
                function i(t, e) {
                    return function (n, i) {
                        var a = n ? r(n) : 0;
                        if (!o(a)) return t(n, i);
                        for (var u = e ? a : -1, l = s(n) ;
                            (e ? u-- : ++u < a) && i(l[u], u, l) !== !1;);
                        return n
                    }
                }
                var r = n(15),
                    o = n(17),
                    s = n(7);
                t.exports = i
            }, function (t, e, n) {
                function i(t, e) {
                    return function (n, i, s) {
                        return "function" == typeof i && void 0 === s && o(n) ? t(n, i) : e(n, r(i, s, 3))
                    }
                }
                var r = n(25),
                    o = n(20);
                t.exports = i
            }, function (t, e, n) {
                function i(t, e, n) {
                    if ("function" != typeof t) return r;
                    if (void 0 === e) return t;
                    switch (n) {
                        case 1:
                            return function (n) {
                                return t.call(e, n)
                            };
                        case 3:
                            return function (n, i, r) {
                                return t.call(e, n, i, r)
                            };
                        case 4:
                            return function (n, i, r, o) {
                                return t.call(e, n, i, r, o)
                            };
                        case 5:
                            return function (n, i, r, o, s) {
                                return t.call(e, n, i, r, o, s)
                            }
                    }
                    return function () {
                        return t.apply(e, arguments)
                    }
                }
                var r = n(26);
                t.exports = i
            }, function (t, e) {
                function n(t) {
                    return t
                }
                t.exports = n
            }, function (t, e, n) {
                "use strict";

                function i(t) {
                    return t && t.__esModule ? t : {
                        "default": t
                    }
                }
                Object.defineProperty(e, "__esModule", {
                    value: !0
                });
                var r = n(28),
                    o = i(r),
                    s = n(12),
                    a = i(s),
                    u = function (t) {
                        return !a["default"](t)
                    },
                    l = o["default"](),
                    c = o["default"]({
                        filter: a["default"]
                    }),
                    f = o["default"]({
                        filter: a["default"],
                        chain: !0
                    }),
                    d = o["default"]({
                        deep: !0
                    }),
                    h = o["default"]({
                        deep: !0,
                        noOverwrite: !0
                    }),
                    p = o["default"]({
                        filter: u,
                        deep: !0,
                        chain: !0
                    });
                e["default"] = o["default"], e.mixin = l, e.mixinFunctions = c, e.mixinChainFunctions = f, e.merge = d, e.mergeUnique = h, e.mergeChainNonFunctions = p
            }, function (t, e, n) {
                "use strict";

                function i(t) {
                    return t && t.__esModule ? t : {
                        "default": t
                    }
                }

                function r() {
                    var t = void 0 === arguments[0] ? {} : arguments[0];
                    return t.deep && !t._innerMixer && (t._innerMixer = !0, t._innerMixer = r(t)),
                        function (e) {
                            function n(n, i) {
                                var r = e[i];
                                if (!t.filter || t.filter(n, r, i)) {
                                    var o = t.deep ? t._innerMixer(r, n) : n;
                                    e[i] = t.transform ? t.transform(o, r, i) : o
                                }
                            }
                            for (var i = arguments.length, r = Array(i > 1 ? i - 1 : 0), o = 1; i > o; o++) r[o - 1] = arguments[o];
                            if (p["default"](e) || !t.noOverwrite && !d["default"](e)) return r.length > 1 ? t._innerMixer.apply(t, [{}].concat(r)) : c["default"](r[0]);
                            if (t.noOverwrite && (!d["default"](e) || !d["default"](r[0]))) return e;
                            var a = t.chain ? u["default"] : s["default"];
                            return r.forEach(function (t) {
                                a(t, n)
                            }), e
                        }
                }
                Object.defineProperty(e, "__esModule", {
                    value: !0
                }), e["default"] = r;
                var o = n(29),
                    s = i(o),
                    a = n(31),
                    u = i(a),
                    l = n(33),
                    c = i(l),
                    f = n(8),
                    d = i(f),
                    h = n(42),
                    p = i(h);
                t.exports = e["default"]
            }, function (t, e, n) {
                var i = n(4),
                    r = n(30),
                    o = r(i);
                t.exports = o
            }, function (t, e, n) {
                function i(t) {
                    return function (e, n, i) {
                        return ("function" != typeof n || void 0 !== i) && (n = r(n, i, 3)), t(e, n)
                    }
                }
                var r = n(25);
                t.exports = i
            }, function (t, e, n) {
                var i = n(5),
                    r = n(32),
                    o = r(i);
                t.exports = o
            }, function (t, e, n) {
                function i(t) {
                    return function (e, n, i) {
                        return ("function" != typeof n || void 0 !== i) && (n = r(n, i, 3)), t(e, n, o)
                    }
                }
                var r = n(25),
                    o = n(22);
                t.exports = i
            }, function (t, e, n) {
                function i(t, e, n) {
                    return "function" == typeof e ? r(t, !0, o(e, n, 1)) : r(t, !0)
                }
                var r = n(34),
                    o = n(25);
                t.exports = i
            }, function (t, e, n) {
                function i(t, e, n, p, g, m, v) {
                    var _;
                    if (n && (_ = g ? n(t, p, g) : n(t)), void 0 !== _) return _;
                    if (!d(t)) return t;
                    var b = f(t);
                    if (b) {
                        if (_ = u(t), !e) return r(t, _)
                    } else {
                        var w = $.call(t),
                            j = w == y;
                        if (w != x && w != h && (!j || g)) return P[w] ? l(t, w, e) : g ? t : {};
                        if (_ = c(j ? {} : t), !e) return s(_, t)
                    }
                    m || (m = []), v || (v = []);
                    for (var C = m.length; C--;)
                        if (m[C] == t) return v[C];
                    return m.push(t), v.push(_), (b ? o : a)(t, function (r, o) {
                        _[o] = i(r, e, n, o, t, m, v)
                    }), _
                }
                var r = n(35),
                    o = n(2),
                    s = n(36),
                    a = n(4),
                    u = n(38),
                    l = n(39),
                    c = n(41),
                    f = n(20),
                    d = n(8),
                    h = "[object Arguments]",
                    p = "[object Array]",
                    g = "[object Boolean]",
                    m = "[object Date]",
                    v = "[object Error]",
                    y = "[object Function]",
                    _ = "[object Map]",
                    b = "[object Number]",
                    x = "[object Object]",
                    w = "[object RegExp]",
                    j = "[object Set]",
                    C = "[object String]",
                    E = "[object WeakMap]",
                    I = "[object ArrayBuffer]",
                    A = "[object Float32Array]",
                    T = "[object Float64Array]",
                    S = "[object Int8Array]",
                    N = "[object Int16Array]",
                    O = "[object Int32Array]",
                    k = "[object Uint8Array]",
                    D = "[object Uint8ClampedArray]",
                    L = "[object Uint16Array]",
                    H = "[object Uint32Array]",
                    P = {};
                P[h] = P[p] = P[I] = P[g] = P[m] = P[A] = P[T] = P[S] = P[N] = P[O] = P[b] = P[x] = P[w] = P[C] = P[k] = P[D] = P[L] = P[H] = !0, P[v] = P[y] = P[_] = P[j] = P[E] = !1;
                var V = Object.prototype,
                    $ = V.toString;
                t.exports = i
            }, function (t, e) {
                function n(t, e) {
                    var n = -1,
                        i = t.length;
                    for (e || (e = Array(i)) ; ++n < i;) e[n] = t[n];
                    return e
                }
                t.exports = n
            }, function (t, e, n) {
                function i(t, e) {
                    return null == e ? t : r(e, o(e), t)
                }
                var r = n(37),
                    o = n(9);
                t.exports = i
            }, function (t, e) {
                function n(t, e, n) {
                    n || (n = {});
                    for (var i = -1, r = e.length; ++i < r;) {
                        var o = e[i];
                        n[o] = t[o]
                    }
                    return n
                }
                t.exports = n
            }, function (t, e) {
                function n(t) {
                    var e = t.length,
                        n = new t.constructor(e);
                    return e && "string" == typeof t[0] && r.call(t, "index") && (n.index = t.index, n.input = t.input), n
                }
                var i = Object.prototype,
                    r = i.hasOwnProperty;
                t.exports = n
            }, function (t, e, n) {
                function i(t, e, n) {
                    var i = t.constructor;
                    switch (e) {
                        case c:
                            return r(t);
                        case o:
                        case s:
                            return new i(+t);
                        case f:
                        case d:
                        case h:
                        case p:
                        case g:
                        case m:
                        case v:
                        case y:
                        case _:
                            var x = t.buffer;
                            return new i(n ? r(x) : x, t.byteOffset, t.length);
                        case a:
                        case l:
                            return new i(t);
                        case u:
                            var w = new i(t.source, b.exec(t));
                            w.lastIndex = t.lastIndex
                    }
                    return w
                }
                var r = n(40),
                    o = "[object Boolean]",
                    s = "[object Date]",
                    a = "[object Number]",
                    u = "[object RegExp]",
                    l = "[object String]",
                    c = "[object ArrayBuffer]",
                    f = "[object Float32Array]",
                    d = "[object Float64Array]",
                    h = "[object Int8Array]",
                    p = "[object Int16Array]",
                    g = "[object Int32Array]",
                    m = "[object Uint8Array]",
                    v = "[object Uint8ClampedArray]",
                    y = "[object Uint16Array]",
                    _ = "[object Uint32Array]",
                    b = /\w*$/;
                t.exports = i
            }, function (t, e) {
                (function (e) {
                    function n(t) {
                        var e = new i(t.byteLength),
                            n = new r(e);
                        return n.set(new r(t)), e
                    }
                    var i = e.ArrayBuffer,
                        r = e.Uint8Array;
                    t.exports = n
                }).call(e, function () {
                    return this
                }())
            }, function (t, e) {
                function n(t) {
                    var e = t.constructor;
                    return "function" == typeof e && e instanceof e || (e = Object), new e
                }
                t.exports = n
            }, function (t, e) {
                function n(t) {
                    return void 0 === t
                }
                t.exports = n
            }])
        }), n("assets/js/portfolio-grid-filter/nav", ["jquery", "underscore", "stampit"], function (t, e, n) {
            return n({
                methods: {
                    onCategoryClick: function (e) {
                        e.preventDefault(), t(e.currentTarget).parent().hasClass("is-active") || (this.filterItems(e), this.updateActiveBtn(e), this.updateUrlHash(e), this.isDesktopLayout() || this.toggleNavHolderState())
                    },
                    toggleNavHolderState: function (t) {
                        return t && t.preventDefault && t.preventDefault(), this.mobileNavOpened ? this.closeFilterMenu() : this.openFilterMenu(), this.toggleNavHolderStateProp(), this
                    },
                    openFilterMenu: function () {
                        var t = this.heightOfAllElmChildren(this.$navHolder);
                        return this.animateNavHolderHeightTo(t), this
                    },
                    closeFilterMenu: function () {
                        var t = this.heightOfActiveChild(this.$navHolder);
                        return this.animateNavHolderHeightTo(t), this
                    },
                    animateNavHolderHeightTo: function (t) {
                        return this.$navHolder.animate({
                            height: t
                        }), this
                    },
                    heightOfAllElmChildren: function (n) {
                        return e.reduce(n.children().not(".is-disabled").get(), function (e, n) {
                            return e + t(n).outerHeight(!0)
                        }, 0)
                    },
                    heightOfActiveChild: function (t) {
                        return t.children(".is-active").first().outerHeight(!0)
                    },
                    filterItems: function (e) {
                        e && e.preventDefault();
                        var n = t(e.target).data("category");
                        return this.render(this.getItemsByCategoryName(n)), this
                    },
                    updateActiveBtn: function (e) {
                        t(e.target).parent().addClass("is-active").siblings(".is-active").removeClass("is-active")
                    },
                    toggleNavHolderStateProp: function () {
                        return this.mobileNavOpened = !this.mobileNavOpened, this
                    },
                    recalcNavHolderStyle: function () {
                        return this.isDesktopLayout() ? (this.$navHolder.removeAttr("style"), this.mobileNavOpened = !1) : this.initNavHolderHeight(), this
                    },
                    initNavHolderHeight: function () {
                        var t = this.heightOfActiveChild(this.$navHolder);
                        return this.$navHolder.outerHeight(t), this.$navHolder.css("padding-top", t), this
                    },
                    isDesktopLayout: function () {
                        return Modernizr.mq("(min-width: " + this.mobileBreakpoint + "px)")
                    },
                    updateUrlHash: function (t) {
                        window.location.hash = t.currentTarget.hash.replace("#", "#" + this.hashPrefix)
                    }
                },
                init: function () {
                    return this.$container.find(this.itemSel).each(e.bind(function (e, n) {
                        this.addItem(t(n))
                    }, this)), this.$navHolder = this.$container.find(this.navHolder), this.$container.on("click.wpg", this.navElmSel, e.bind(this.onCategoryClick, this)), this.$container.on("click.wpg", this.navMobileFilter, e.bind(this.toggleNavHolderState, this)), t(window).on("resize", e.debounce(e.bind(this.recalcNavHolderStyle, this), 50)), this.recalcNavHolderStyle(), this
                },
                props: {
                    mobileNavOpened: !1,
                    mobileBreakpoint: 992
                }
            })
        }), n("assets/js/portfolio-grid-filter/items", ["jquery", "underscore", "stampit"], function (t, e, n) {
            return n({
                methods: {
                    addItem: function (t) {
                        return this.$items.push({
                            categories: this.getItemCagories(t),
                            $elm: t
                        }), this
                    },
                    getItemsByCategoryName: function (t) {
                        return "*" === t ? this.getItems() : e.chain(this.$items).filter(function (n) {
                            return e.contains(n.categories, t)
                        }).pluck("$elm").value()
                    },
                    getItemCagories: function (t) {
                        return t.data("categories").split(",")
                    },
                    getItems: function () {
                        return e.pluck(this.$items, "$elm")
                    }
                },
                props: {
                    $items: []
                }
            })
        }), n("assets/js/portfolio-grid-filter/generalView", ["jquery", "underscore", "stampit"], function (t, e, n) {
            return n({
                init: function () {
                    return this.$itemsContainer = this.$container.find(this.itemsContainerSel), this
                },
                methods: {
                    groupArrayItems: function (t, n) {
                        return e.chain(n).groupBy(function (e, n) {
                            return Math.floor(n / t)
                        }).values().value()
                    },
                    render: function (t) {
                        this.$container.trigger(this.eventsNS + "before_render", {
                            items: t
                        });
                        var n = this.$itemsContainer.children();
                        e.forEach(this.getItems(), function (t) {
                            t.find(this.cardSel).addClass("is-fadeout")
                        }, this);
                        var i = this.groupArrayItems(this.itemsPerRow, t);
                        return setTimeout(e.bind(function () {
                            e.forEach(i, function (t) {
                                this.createNewRow(t).appendTo(this.$itemsContainer)
                            }, this), n.remove(), this.afterRendered && this.afterRendered(), this.$container.trigger(this.eventsNS + "on_elements_switch", {
                                items: t
                            })
                        }, this), 200), this
                    },
                    createNewRow: function (n) {
                        var i = t(this.rowHTML);
                        return n.forEach(function (t) {
                            var n = t.find(this.cardSel);
                            n.removeClass("is-fadeout").addClass("is-fadein"), setTimeout(e.bind(function (t) {
                                this.removeClass("is-fadein")
                            }, n), 200), e.isString(this.appendItemsInside) ? t.appendTo(i.find(this.appendItemsInside)) : t.appendTo(i)
                        }.bind(this)), i
                    }
                },
                props: {
                    itemsPerRow: 4
                }
            })
        }), n("assets/js/portfolio-grid-filter/gridView", ["stampit", "assets/js/portfolio-grid-filter/generalView"], function (t, e) {
            return t().refs({
                rowHTML: '<div class="row"></div>'
            }).compose(e)
        }), n("assets/js/portfolio-grid-filter/selectors", ["stampit"], function (t) {
            return t().props({
                navElmSel: ".js-wpg-nav",
                navHolder: ".js-wpg-nav-holder",
                navMobileFilter: ".js-filter",
                itemsContainerSel: ".js-wpg-items",
                itemSel: ".js-wpg-item",
                cardSel: ".js-wpg-card",
                eventsNS: "wpge_",
                hashPrefix: "projects_"
            })
        }), n("assets/js/portfolio-grid-filter/gridFilter", ["stampit", "assets/js/portfolio-grid-filter/nav", "assets/js/portfolio-grid-filter/items", "assets/js/portfolio-grid-filter/gridView", "assets/js/portfolio-grid-filter/selectors"], function (t, e, n, i, r) {
            return t().compose(e, n, i, r)
        }), n("assets/js/portfolio-grid-filter/navSlider", ["jquery", "underscore", "stampit", "assets/js/portfolio-grid-filter/nav"], function (t, e, n, i) {
            return i.compose(n({
                methods: {
                    toggleArrowsVisibility: function (t, e) {
                        return this.$container.toggleClass("is-nav-arrows-hidden", this.arrowsHidden(e.items.length)), this
                    },
                    arrowsHidden: function (t) {
                        return t <= this.itemsPerRow
                    }
                },
                init: function () {
                    return this.$container.on(this.eventsNS + "before_render", e.bind(this.toggleArrowsVisibility, this)), this
                }
            }))
        }), n("assets/js/portfolio-grid-filter/sliderView", ["jquery", "stampit", "assets/js/portfolio-grid-filter/generalView"], function (t, e, n) {
            return e({
                props: {
                    rowHTML: '<div class = "carousel-item"><div class="row"></div></div>',
                    appendItemsInside: ".row",
                    arrowsSel: ".js-wpg-arrows"
                },
                methods: {
                    afterRendered: function () {
                        return this.$itemsContainer.children().first().addClass("active"), this
                    }
                }
            }).compose(n)
        }), n("assets/js/portfolio-grid-filter/sliderFilter", ["stampit", "assets/js/portfolio-grid-filter/navSlider", "assets/js/portfolio-grid-filter/items", "assets/js/portfolio-grid-filter/sliderView", "assets/js/portfolio-grid-filter/selectors"], function (t, e, n, i, r) {
            return t().compose(e, n, i, r)
        }), n("assets/js/utils/isElementInView", ["jquery"], function (t) {
            return function (e) {
                var n = t(window),
                    i = n.scrollTop(),
                    r = i + n.height(),
                    o = e.offset().top,
                    s = o + e.height();
                return s > i && r > o
            }
        }), n("assets/js/utils/easeInOutQuad", ["jquery"], function (t) {
            return function () {
                t.extend(t.easing, {
                    easeInOutQuad: function (t, e, n, i, r) {
                        return (e /= r / 2) < 1 ? i / 2 * e * e + n : -i / 2 * (--e * (e - 2) - 1) + n
                    }
                })
            }
        }), n("vendor/proteusthemes/proteuswidgets/assets/js/NumberCounter", ["jquery", "underscore"], function (t, e) {
            "use strict";
            var n = {
                eventNS: "widgetCounter",
                numberContainerClass: ".js-number",
                progressBarContainerClass: ".js-nc-progress-bar"
            },
                i = function (i) {
                    return this.$widgetElement = i, this.uniqueNS = e.uniqueId(n.eventNS), this.registerListeners(), t(window).trigger("scroll." + this.uniqueNS), this
                },
                r = function (t, e) {
                    for (var n = "" + t; n.length < e;) n = "0" + n;
                    return n
                };
            return e.extend(i.prototype, {
                registerListeners: function () {
                    return t(window).on("scroll." + this.uniqueNS, e.throttle(e.bind(function () {
                        this.widgetScrolledIntoView() && this.triggerCounting()
                    }, this), 500)), this
                },
                destroyListeners: function () {
                    return t(window).off("scroll." + this.uniqueNS), this
                },
                triggerCounting: function () {
                    e.each(this.getSingleNumbersInWidget(), function (t) {
                        this.animateValue(t, 0, t.data("to"), this.$widgetElement.data("speed"))
                    }, this);
                    var t = this.getProgressBarsForThisWidget();
                    t.length && e.each(t, function (t) {
                        t.css("width", parseInt(t.data("progress-bar-value"), 10) + "%")
                    }, this), this.destroyListeners()
                },
                getProgressBarsForThisWidget: function () {
                    var e = [];
                    return this.$widgetElement.find(n.progressBarContainerClass).each(function () {
                        e.push(t(this))
                    }), e
                },
                getSingleNumbersInWidget: function () {
                    var e = [];
                    return this.$widgetElement.find(n.numberContainerClass).each(function () {
                        e.push(t(this))
                    }), e
                },
                animateValue: function (e, n, i, o) {
                    t({
                        Counter: n
                    }).animate({
                        Counter: i
                    }, {
                        duration: o,
                        easing: "easeInOutQuad",
                        step: function () {
                            e.text(r(Math.ceil(this.Counter), i.toString().length))
                        }
                    })
                },
                widgetScrolledIntoView: function () {
                    var e = t(window).scrollTop(),
                        n = e + t(window).height(),
                        i = this.$widgetElement.children(".number-counter").first().offset().top,
                        r = i + this.$widgetElement.children(".number-counter").first().height();
                    return n >= r && i >= e
                }
            }), i
        }), n("assets/js/StickyNavbar", ["jquery", "underscore"], function (t, e) {
            "use strict";
            var n = t("body").hasClass("admin-bar") ? 32 : 0,
                i = 0,
                r = t(".js-sticky-offset").offset().top + i,
                o = "sticky-navigation";
            t("body").on("update_sticky_state.pt", function () {
                t("body").hasClass(o) ? (s(), t(window).trigger("scroll.stickyNavbar")) : a()
            });
            var s = function () {
                t(window).on("scroll.stickyNavbar", e.throttle(function () {
                    t("body").toggleClass("is-sticky-nav", t(window).scrollTop() > r - n)
                }, 20))
            },
                a = function () {
                    t(window).off("scroll.stickyNavbar"), t("body").removeClass("is-sticky-nav")
                };
            t(window).on("resize.stickyNavbar", e.debounce(function () {
                r = t(".js-sticky-offset").offset().top + i, t("body").trigger("update_sticky_state.pt")
            }, 40)), t(window).trigger("resize.stickyNavbar")
        }), n("assets/js/TouchDropdown", ["jquery"], function (t) {
            "use strict";
            Modernizr && Modernizr.touchevents && Modernizr.mq("(min-width: 992px)") && (t("ul.js-dropdown").find(".sub-menu").addClass("js-dropdown"), t("ul.js-dropdown").each(function (e, n) {
                t(n).children(".menu-item-has-children").on("click.td", "a", function (e) {
                    e.preventDefault(), t(n).children(".is-hover").removeClass("is-hover"), t(e.delegateTarget).addClass("is-hover"), t(e.delegateTarget).off("click.td")
                })
            }))
        }),
        function (t, e) {
            if ("function" == typeof n && n.amd) n("util", ["exports", "module"], e);
            else if ("undefined" != typeof exports && "undefined" != typeof module) e(exports, module);
            else {
                var i = {
                    exports: {}
                };
                e(i.exports, i), t.util = i.exports
            }
        }(this, function (t, e) {
            "use strict";
            var n = function (t) {
                function e(t) {
                    return {}.toString.call(t).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
                }

                function n(t) {
                    return (t[0] || t).nodeType
                }

                function i() {
                    return {
                        bindType: a.end,
                        delegateType: a.end,
                        handle: function (e) {
                            return t(e.target).is(this) ? e.handleObj.handler.apply(this, arguments) : void 0
                        }
                    }
                }

                function r() {
                    if (window.QUnit) return !1;
                    var t = document.createElement("bootstrap");
                    for (var e in u)
                        if (void 0 !== t.style[e]) return {
                            end: u[e]
                        };
                    return !1
                }

                function o(e) {
                    var n = this,
                        i = !1;
                    return t(this).one(l.TRANSITION_END, function () {
                        i = !0
                    }), setTimeout(function () {
                        i || l.triggerTransitionEnd(n)
                    }, e), this
                }

                function s() {
                    a = r(), t.fn.emulateTransitionEnd = o, l.supportsTransitionEnd() && (t.event.special[l.TRANSITION_END] = i())
                }
                var a = !1,
                    u = {
                        WebkitTransition: "webkitTransitionEnd",
                        MozTransition: "transitionend",
                        OTransition: "oTransitionEnd otransitionend",
                        transition: "transitionend"
                    },
                    l = {
                        TRANSITION_END: "bsTransitionEnd",
                        getUID: function (t) {
                            do t += ~~(1e6 * Math.random()); while (document.getElementById(t));
                            return t
                        },
                        getSelectorFromElement: function (t) {
                            var e = t.getAttribute("data-target");
                            return e || (e = t.getAttribute("href") || "", e = /^#[a-z]/i.test(e) ? e : null), e
                        },
                        reflow: function (t) {
                            new Function("bs", "return bs")(t.offsetHeight)
                        },
                        triggerTransitionEnd: function (e) {
                            t(e).trigger(a.end)
                        },
                        supportsTransitionEnd: function () {
                            return Boolean(a)
                        },
                        typeCheckConfig: function (t, i, r) {
                            for (var o in r)
                                if (r.hasOwnProperty(o)) {
                                    var s = r[o],
                                        a = i[o],
                                        u = void 0;
                                    if (u = a && n(a) ? "element" : e(a), !new RegExp(s).test(u)) throw new Error(t.toUpperCase() + ": " + ('Option "' + o + '" provided type "' + u + '" ') + ('but expected type "' + s + '".'))
                                }
                        }
                    };
                return s(), l
            }(jQuery);
            e.exports = n
        }),
        function (t, i) {
            if ("function" == typeof n && n.amd) n("carousel", ["exports", "module", "./util"], i);
            else if ("undefined" != typeof exports && "undefined" != typeof module) i(exports, module, e("./util"));
            else {
                var r = {
                    exports: {}
                };
                i(r.exports, r, t.Util), t.carousel = r.exports
            }
        }(this, function (t, e, n) {
            "use strict";

            function i(t) {
                return t && t.__esModule ? t : {
                    "default": t
                }
            }

            function r(t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }
            var o = function () {
                function t(t, e) {
                    for (var n = 0; n < e.length; n++) {
                        var i = e[n];
                        i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
                    }
                }
                return function (e, n, i) {
                    return n && t(e.prototype, n), i && t(e, i), e
                }
            }(),
                s = i(n),
                a = function (t) {
                    var e = "carousel",
                        n = "4.0.0-alpha",
                        i = "bs.carousel",
                        a = "." + i,
                        u = ".data-api",
                        l = t.fn[e],
                        c = 600,
                        f = {
                            interval: 1,
                            keyboard: !0,
                            slide: !1,
                            pause: "hover",
                            wrap: !0
                        },
                        d = {
                            interval: "(number|boolean)",
                            keyboard: "boolean",
                            slide: "(boolean|string)",
                            pause: "(string|boolean)",
                            wrap: "boolean"
                        },
                        h = {
                            NEXT: "next",
                            PREVIOUS: "prev"
                        },
                        p = {
                            SLIDE: "slide" + a,
                            SLID: "slid" + a,
                            KEYDOWN: "keydown" + a,
                            MOUSEENTER: "mouseenter" + a,
                            MOUSELEAVE: "mouseleave" + a,
                            LOAD_DATA_API: "load" + a + u,
                            CLICK_DATA_API: "click" + a + u
                        },
                        g = {
                            CAROUSEL: "carousel",
                            ACTIVE: "active",
                            SLIDE: "slide",
                            RIGHT: "right",
                            LEFT: "left",
                            ITEM: "carousel-item"
                        },
                        m = {
                            ACTIVE: ".active",
                            ACTIVE_ITEM: ".active.carousel-item",
                            ITEM: ".carousel-item",
                            NEXT_PREV: ".next, .prev",
                            INDICATORS: ".carousel-indicators",
                            DATA_SLIDE: "[data-slide], [data-slide-to]",
                            DATA_RIDE: '[data-ride="carousel"]'
                        },
                        v = function () {
                            function u(e, n) {
                                r(this, u), this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this._config = this._getConfig(n), this._element = t(e)[0], this._indicatorsElement = t(this._element).find(m.INDICATORS)[0], this._addEventListeners()
                            }
                            return o(u, [{
                                key: "next",
                                value: function () {
                                    this._isSliding || this._slide(h.NEXT)
                                }
                            }, {
                                key: "nextWhenVisible",
                                value: function () {
                                    document.hidden || this.next()
                                }
                            }, {
                                key: "prev",
                                value: function () {
                                    this._isSliding || this._slide(h.PREVIOUS)
                                }
                            }, {
                                key: "pause",
                                value: function (e) {
                                    e || (this._isPaused = !0), t(this._element).find(m.NEXT_PREV)[0] && s["default"].supportsTransitionEnd() && (s["default"].triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null
                                }
                            }, {
                                key: "cycle",
                                value: function (e) {
                                    e || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval(t.proxy(document.visibilityState ? this.nextWhenVisible : this.next, this), this._config.interval))
                                }
                            }, {
                                key: "to",
                                value: function (e) {
                                    var n = this;
                                    this._activeElement = t(this._element).find(m.ACTIVE_ITEM)[0];
                                    var i = this._getItemIndex(this._activeElement);
                                    if (!(e > this._items.length - 1 || 0 > e)) {
                                        if (this._isSliding) return void t(this._element).one(p.SLID, function () {
                                            return n.to(e)
                                        });
                                        if (i === e) return this.pause(), void this.cycle();
                                        var r = e > i ? h.NEXT : h.PREVIOUS;
                                        this._slide(r, this._items[e])
                                    }
                                }
                            }, {
                                key: "dispose",
                                value: function () {
                                    t(this._element).off(a), t.removeData(this._element, i), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null
                                }
                            }, {
                                key: "_getConfig",
                                value: function (n) {
                                    return n = t.extend({}, f, n), s["default"].typeCheckConfig(e, n, d), n
                                }
                            }, {
                                key: "_addEventListeners",
                                value: function () {
                                    this._config.keyboard && t(this._element).on(p.KEYDOWN, t.proxy(this._keydown, this)), "hover" !== this._config.pause || "ontouchstart" in document.documentElement || t(this._element).on(p.MOUSEENTER, t.proxy(this.pause, this)).on(p.MOUSELEAVE, t.proxy(this.cycle, this))
                                }
                            }, {
                                key: "_keydown",
                                value: function (t) {
                                    if (t.preventDefault(), !/input|textarea/i.test(t.target.tagName)) switch (t.which) {
                                        case 37:
                                            this.prev();
                                            break;
                                        case 39:
                                            this.next();
                                            break;
                                        default:
                                            return
                                    }
                                }
                            }, {
                                key: "_getItemIndex",
                                value: function (e) {
                                    return this._items = t.makeArray(t(e).parent().find(m.ITEM)), this._items.indexOf(e)
                                }
                            }, {
                                key: "_getItemByDirection",
                                value: function (t, e) {
                                    var n = t === h.NEXT,
                                        i = t === h.PREVIOUS,
                                        r = this._getItemIndex(e),
                                        o = this._items.length - 1,
                                        s = i && 0 === r || n && r === o;
                                    if (s && !this._config.wrap) return e;
                                    var a = t === h.PREVIOUS ? -1 : 1,
                                        u = (r + a) % this._items.length;
                                    return -1 === u ? this._items[this._items.length - 1] : this._items[u]
                                }
                            }, {
                                key: "_triggerSlideEvent",
                                value: function (e, n) {
                                    var i = t.Event(p.SLIDE, {
                                        relatedTarget: e,
                                        direction: n
                                    });
                                    return t(this._element).trigger(i), i
                                }
                            }, {
                                key: "_setActiveIndicatorElement",
                                value: function (e) {
                                    if (this._indicatorsElement) {
                                        t(this._indicatorsElement).find(m.ACTIVE).removeClass(g.ACTIVE);
                                        var n = this._indicatorsElement.children[this._getItemIndex(e)];
                                        n && t(n).addClass(g.ACTIVE)
                                    }
                                }
                            }, {
                                key: "_slide",
                                value: function (e, n) {
                                    var i = this,
                                        r = t(this._element).find(m.ACTIVE_ITEM)[0],
                                        o = n || r && this._getItemByDirection(e, r),
                                        a = Boolean(this._interval),
                                        u = e === h.NEXT ? g.LEFT : g.RIGHT;
                                    if (o && t(o).hasClass(g.ACTIVE)) return void (this._isSliding = !1);
                                    var l = this._triggerSlideEvent(o, u);
                                    if (!l.isDefaultPrevented() && r && o) {
                                        this._isSliding = !0,
                                            a && this.pause(), this._setActiveIndicatorElement(o);
                                        var f = t.Event(p.SLID, {
                                            relatedTarget: o,
                                            direction: u
                                        });
                                        s["default"].supportsTransitionEnd() && t(this._element).hasClass(g.SLIDE) ? (t(o).addClass(e), s["default"].reflow(o), t(r).addClass(u), t(o).addClass(u), t(r).one(s["default"].TRANSITION_END, function () {
                                            t(o).removeClass(u).removeClass(e), t(o).addClass(g.ACTIVE), t(r).removeClass(g.ACTIVE).removeClass(e).removeClass(u), i._isSliding = !1, setTimeout(function () {
                                                return t(i._element).trigger(f)
                                            }, 0)
                                        }).emulateTransitionEnd(c)) : (t(r).removeClass(g.ACTIVE), t(o).addClass(g.ACTIVE), this._isSliding = !1, t(this._element).trigger(f)), a && this.cycle()
                                    }
                                }
                            }], [{
                                key: "_jQueryInterface",
                                value: function (e) {
                                    return this.each(function () {
                                        var n = t(this).data(i),
                                            r = t.extend({}, f, t(this).data());
                                        "object" == typeof e && t.extend(r, e);
                                        var o = "string" == typeof e ? e : r.slide;
                                        if (n || (n = new u(this, r), t(this).data(i, n)), "number" == typeof e) n.to(e);
                                        else if ("string" == typeof o) {
                                            if (void 0 === n[o]) throw new Error('No method named "' + o + '"');
                                            n[o]()
                                        } else r.interval && (n.pause(), n.cycle())
                                    })
                                }
                            }, {
                                key: "_dataApiClickHandler",
                                value: function (e) {
                                    var n = s["default"].getSelectorFromElement(this);
                                    if (n) {
                                        var r = t(n)[0];
                                        if (r && t(r).hasClass(g.CAROUSEL)) {
                                            var o = t.extend({}, t(r).data(), t(this).data()),
                                                a = this.getAttribute("data-slide-to");
                                            a && (o.interval = !1), u._jQueryInterface.call(t(r), o), a && t(r).data(i).to(a), e.preventDefault()
                                        }
                                    }
                                }
                            }, {
                                key: "VERSION",
                                get: function () {
                                    return n
                                }
                            }, {
                                key: "Default",
                                get: function () {
                                    return f
                                }
                            }]), u
                        }();
                    return t(document).on(p.CLICK_DATA_API, m.DATA_SLIDE, v._dataApiClickHandler), t(window).on(p.LOAD_DATA_API, function () {
                        t(m.DATA_RIDE).each(function () {
                            var e = t(this);
                            v._jQueryInterface.call(e, e.data())
                        })
                    }), t.fn[e] = v._jQueryInterface, t.fn[e].Constructor = v, t.fn[e].noConflict = function () {
                        return t.fn[e] = l, v._jQueryInterface
                    }, v
                }(jQuery);
            e.exports = a
        }),
        function (t, i) {
            if ("function" == typeof n && n.amd) n("collapse", ["exports", "module", "./util"], i);
            else if ("undefined" != typeof exports && "undefined" != typeof module) i(exports, module, e("./util"));
            else {
                var r = {
                    exports: {}
                };
                i(r.exports, r, t.Util), t.collapse = r.exports
            }
        }(this, function (t, e, n) {
            "use strict";

            function i(t) {
                return t && t.__esModule ? t : {
                    "default": t
                }
            }

            function r(t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }
            var o = function () {
                function t(t, e) {
                    for (var n = 0; n < e.length; n++) {
                        var i = e[n];
                        i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
                    }
                }
                return function (e, n, i) {
                    return n && t(e.prototype, n), i && t(e, i), e
                }
            }(),
                s = i(n),
                a = function (t) {
                    var e = "collapse",
                        n = "4.0.0-alpha",
                        i = "bs.collapse",
                        a = "." + i,
                        u = ".data-api",
                        l = t.fn[e],
                        c = 600,
                        f = {
                            toggle: !0,
                            parent: ""
                        },
                        d = {
                            toggle: "boolean",
                            parent: "string"
                        },
                        h = {
                            SHOW: "show" + a,
                            SHOWN: "shown" + a,
                            HIDE: "hide" + a,
                            HIDDEN: "hidden" + a,
                            CLICK_DATA_API: "click" + a + u
                        },
                        p = {
                            IN: "in",
                            COLLAPSE: "collapse",
                            COLLAPSING: "collapsing",
                            COLLAPSED: "collapsed"
                        },
                        g = {
                            WIDTH: "width",
                            HEIGHT: "height"
                        },
                        m = {
                            ACTIVES: ".panel > .in, .panel > .collapsing",
                            DATA_TOGGLE: '[data-toggle="collapse"]'
                        },
                        v = function () {
                            function a(e, n) {
                                r(this, a), this._isTransitioning = !1, this._element = e, this._config = this._getConfig(n), this._triggerArray = t.makeArray(t('[data-toggle="collapse"][href="#' + e.id + '"],' + ('[data-toggle="collapse"][data-target="#' + e.id + '"]'))), this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle()
                            }
                            return o(a, [{
                                key: "toggle",
                                value: function () {
                                    t(this._element).hasClass(p.IN) ? this.hide() : this.show()
                                }
                            }, {
                                key: "show",
                                value: function () {
                                    var e = this;
                                    if (!this._isTransitioning && !t(this._element).hasClass(p.IN)) {
                                        var n = void 0,
                                            r = void 0;
                                        if (this._parent && (n = t.makeArray(t(m.ACTIVES)), n.length || (n = null)), !(n && (r = t(n).data(i), r && r._isTransitioning))) {
                                            var o = t.Event(h.SHOW);
                                            if (t(this._element).trigger(o), !o.isDefaultPrevented()) {
                                                n && (a._jQueryInterface.call(t(n), "hide"), r || t(n).data(i, null));
                                                var u = this._getDimension();
                                                t(this._element).removeClass(p.COLLAPSE).addClass(p.COLLAPSING), this._element.style[u] = 0, this._element.setAttribute("aria-expanded", !0), this._triggerArray.length && t(this._triggerArray).removeClass(p.COLLAPSED).attr("aria-expanded", !0), this.setTransitioning(!0);
                                                var l = function () {
                                                    t(e._element).removeClass(p.COLLAPSING).addClass(p.COLLAPSE).addClass(p.IN), e._element.style[u] = "", e.setTransitioning(!1), t(e._element).trigger(h.SHOWN)
                                                };
                                                if (!s["default"].supportsTransitionEnd()) return void l();
                                                var f = u[0].toUpperCase() + u.slice(1),
                                                    d = "scroll" + f;
                                                t(this._element).one(s["default"].TRANSITION_END, l).emulateTransitionEnd(c), this._element.style[u] = this._element[d] + "px"
                                            }
                                        }
                                    }
                                }
                            }, {
                                key: "hide",
                                value: function () {
                                    var e = this;
                                    if (!this._isTransitioning && t(this._element).hasClass(p.IN)) {
                                        var n = t.Event(h.HIDE);
                                        if (t(this._element).trigger(n), !n.isDefaultPrevented()) {
                                            var i = this._getDimension(),
                                                r = i === g.WIDTH ? "offsetWidth" : "offsetHeight";
                                            this._element.style[i] = this._element[r] + "px", s["default"].reflow(this._element), t(this._element).addClass(p.COLLAPSING).removeClass(p.COLLAPSE).removeClass(p.IN), this._element.setAttribute("aria-expanded", !1), this._triggerArray.length && t(this._triggerArray).addClass(p.COLLAPSED).attr("aria-expanded", !1), this.setTransitioning(!0);
                                            var o = function () {
                                                e.setTransitioning(!1), t(e._element).removeClass(p.COLLAPSING).addClass(p.COLLAPSE).trigger(h.HIDDEN)
                                            };
                                            return this._element.style[i] = 0, s["default"].supportsTransitionEnd() ? void t(this._element).one(s["default"].TRANSITION_END, o).emulateTransitionEnd(c) : void o()
                                        }
                                    }
                                }
                            }, {
                                key: "setTransitioning",
                                value: function (t) {
                                    this._isTransitioning = t
                                }
                            }, {
                                key: "dispose",
                                value: function () {
                                    t.removeData(this._element, i), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null
                                }
                            }, {
                                key: "_getConfig",
                                value: function (n) {
                                    return n = t.extend({}, f, n), n.toggle = Boolean(n.toggle), s["default"].typeCheckConfig(e, n, d), n
                                }
                            }, {
                                key: "_getDimension",
                                value: function () {
                                    var e = t(this._element).hasClass(g.WIDTH);
                                    return e ? g.WIDTH : g.HEIGHT
                                }
                            }, {
                                key: "_getParent",
                                value: function () {
                                    var e = this,
                                        n = t(this._config.parent)[0],
                                        i = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]';
                                    return t(n).find(i).each(function (t, n) {
                                        e._addAriaAndCollapsedClass(a._getTargetFromElement(n), [n])
                                    }), n
                                }
                            }, {
                                key: "_addAriaAndCollapsedClass",
                                value: function (e, n) {
                                    if (e) {
                                        var i = t(e).hasClass(p.IN);
                                        e.setAttribute("aria-expanded", i), n.length && t(n).toggleClass(p.COLLAPSED, !i).attr("aria-expanded", i)
                                    }
                                }
                            }], [{
                                key: "_getTargetFromElement",
                                value: function (e) {
                                    var n = s["default"].getSelectorFromElement(e);
                                    return n ? t(n)[0] : null
                                }
                            }, {
                                key: "_jQueryInterface",
                                value: function (e) {
                                    return this.each(function () {
                                        var n = t(this),
                                            r = n.data(i),
                                            o = t.extend({}, f, n.data(), "object" == typeof e && e);
                                        if (!r && o.toggle && /show|hide/.test(e) && (o.toggle = !1), r || (r = new a(this, o), n.data(i, r)), "string" == typeof e) {
                                            if (void 0 === r[e]) throw new Error('No method named "' + e + '"');
                                            r[e]()
                                        }
                                    })
                                }
                            }, {
                                key: "VERSION",
                                get: function () {
                                    return n
                                }
                            }, {
                                key: "Default",
                                get: function () {
                                    return f
                                }
                            }]), a
                        }();
                    return t(document).on(h.CLICK_DATA_API, m.DATA_TOGGLE, function (e) {
                        e.preventDefault();
                        var n = v._getTargetFromElement(this),
                            r = t(n).data(i),
                            o = r ? "toggle" : t(this).data();
                        v._jQueryInterface.call(t(n), o)
                    }), t.fn[e] = v._jQueryInterface, t.fn[e].Constructor = v, t.fn[e].noConflict = function () {
                        return t.fn[e] = l, v._jQueryInterface
                    }, v
                }(jQuery);
            e.exports = a
        }), e.config({
            paths: {
                jquery: "assets/js/fix.jquery",
                underscore: "assets/js/fix.underscore",
                util: "bower_components/bootstrap/dist/js/umd/util",
                alert: "bower_components/bootstrap/dist/js/umd/alert",
                button: "bower_components/bootstrap/dist/js/umd/button",
                carousel: "bower_components/bootstrap/dist/js/umd/carousel",
                collapse: "bower_components/bootstrap/dist/js/umd/collapse",
                dropdown: "bower_components/bootstrap/dist/js/umd/dropdown",
                modal: "bower_components/bootstrap/dist/js/umd/modal",
                scrollspy: "bower_components/bootstrap/dist/js/umd/scrollspy",
                tab: "bower_components/bootstrap/dist/js/umd/tab",
                tooltip: "bower_components/bootstrap/dist/js/umd/tooltip",
                popover: "bower_components/bootstrap/dist/js/umd/popover",
                stampit: "bower_components/stampit/stampit"
            }
        }), e.config({
            baseUrl: "assets/theme"
        }), e(["jquery", "underscore", "assets/js/portfolio-grid-filter/gridFilter", "assets/js/portfolio-grid-filter/sliderFilter", "assets/js/utils/isElementInView", "assets/js/utils/easeInOutQuad", "vendor/proteusthemes/proteuswidgets/assets/js/NumberCounter", "assets/js/StickyNavbar", "assets/js/TouchDropdown", "carousel", "collapse"], function (t, e, n, i, r, o, s) {
            "use strict";
            t(".col-md-__col-num__").removeClass("col-md-__col-num__").addClass("col-md-3");
            var a = t(".number-counters");
            a.length && (o(), a.each(function () {
                new s(t(this))
            })), t(".portfolio-grid").each(function () {
                var e, r = window.location.hash;
                e = "slider" === t(this).data("type") ? i({
                    $container: t(this)
                }) : n({
                    $container: t(this)
                }), new RegExp("^#" + e.hashPrefix).test(r) ? t(this).find('a[href="' + r.replace(e.hashPrefix, "") + '"]').trigger("click") : t(this).find(".portfolio-grid__nav-item").first().hasClass("is-disabled") && t(this).find(".portfolio-grid__nav-item:nth-child(2)").children(".portfolio-grid__nav-link").trigger("click"), !e.isDesktopLayout() && t(this).find(".portfolio-grid__nav-item").first().hasClass("is-disabled") && e.initNavHolderHeight()
            }),
                function () {
                    var n = t(".js-jumbotron-slider");
                    n.length && t(document).on("scroll", e.throttle(function () {
                        r(n) ? n.carousel("cycle") : n.carousel("pause")
                    }, 1e3, {
                        leading: !1
                    }))
                }()
        }), n("assets/js/main", function () { })
}();