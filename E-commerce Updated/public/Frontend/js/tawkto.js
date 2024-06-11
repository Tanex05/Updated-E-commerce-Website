var Tawk_API = Tawk_API || {};
Tawk_API.visitor = {
    name: tawktoVisitorName,
};
(function () {
    if (typeof tawktoScriptUrl !== "undefined" && tawktoScriptUrl !== "") {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = tawktoScriptUrl; // Remove additional quotes here
        s1.charset = "UTF-8";
        s1.setAttribute("crossorigin", "*");
        s0.parentNode.insertBefore(s1, s0);
    }
})();
