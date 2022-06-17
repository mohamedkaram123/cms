export default function is_script_rtl(t) {
    var d, s1, s2, bodies;

    //If the browser doesn’t support this, it probably doesn’t support Unicode 5.2
    if (!("getBoundingClientRect" in document.documentElement))
        return false;

    //Set up a testing DIV
    d = document.createElement('div');
    d.style.position = 'absolute';
    d.style.visibility = 'hidden';
    d.style.width = 'auto';
    d.style.height = 'auto';
    d.style.fontSize = '10px';
    d.style.fontFamily = "'Ahuramzda'";
    d.appendChild(document.createTextNode(t));

    s1 = document.createElement("span");
    s1.appendChild(document.createTextNode(t));
    d.appendChild(s1);

    s2 = document.createElement("span");
    s2.appendChild(document.createTextNode(t));
    d.appendChild(s2);

    d.appendChild(document.createTextNode(t));

    bodies = document.getElementsByTagName('body');
    if (bodies) {
        var body, r1, r2;

        body = bodies[0];
        body.appendChild(d);
        var r1 = s1.getBoundingClientRect();
        var r2 = s2.getBoundingClientRect();
        body.removeChild(d);

        return r1.left > r2.left;
    }

    return false;
}