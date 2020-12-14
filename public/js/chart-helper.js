const randomColor = (() => {
    "use strict";

    const randomInt = (min, max) => {
        return Math.floor(Math.random() * (max - min + 1)) + min
    };

    return () => {
        let h = randomInt(0, 360)
        let s = randomInt(42, 98)
        let l = randomInt(40, 90)
        return {
            h: h,
            s: s,
            l: l,
        }
    };
})();

let hslObjectToString = function(hslObject, alpha = 1) {
    if (alpha < 1) {
        alpha*=100
        return `hsla(${hslObject.h},${hslObject.s}%,${hslObject.l}%,${alpha}%)`;
    }
    return `hsl(${hslObject.h},${hslObject.s}%,${hslObject.l}%)`;
}

let rgbObjectToString = function(rgbObject, alpha = 1) {
    if (alpha < 1) {
        alpha*=100
        return `rgba(${rgbObject.r},${rgbObject.g}%,${rgbObject.b}%,${alpha}%)`;
    }
    return `rgb(${rgbObject.r},${rgbObject.g}%,${rgbObject.b}%)`;
}

let hslObjectToRgbObject = function(hslObject){
    let h = hslObject.h
    let s = hslObject.s
    let l = hslObject.l
    let r, g, b;

    if(s == 0){
        r = g = b = l; // achromatic
    }else{
        let hue2rgb = function hue2rgb(p, q, t){
            if(t < 0) t += 1;
            if(t > 1) t -= 1;
            if(t < 1/6) return p + (q - p) * 6 * t;
            if(t < 1/2) return q;
            if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        let q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        let p = 2 * l - q;
        r = hue2rgb(p, q, h + 1/3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1/3);
    }

    return {
        r: Math.round(r * 255),
        g: Math.round(g * 255),
        b: Math.round(b * 255),
    }
}

let rgbObjectToHslObject = function(rgbObject){
    let r = rgbObject.r
    let g = rgbObject.g
    let b = rgbObject.b

    r /= 255, g /= 255, b /= 255;
    let max = Math.max(r, g, b), min = Math.min(r, g, b);
    let h, s, l = (max + min) / 2;

    if(max == min){
        h = s = 0; // achromatic
    }else{
        let d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        switch(max){
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }
        h /= 6;
    }

    return {
        h: h,
        s: s,
        l: l
    }
}
