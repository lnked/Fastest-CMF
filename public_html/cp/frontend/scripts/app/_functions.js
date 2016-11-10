"use strict";

function __() {try {for(var i=0; i<arguments.length; i++) {console.log(arguments[i]);}}catch (e) {}}

function sprintf(v) {
  var split = v.toString().split('.'), pad = "00", time = [], x = null;

  for (x in split) {
    time.push(pad.substring(0, 2 - split[x].toString().length) + split[x]);
  }

  return time.join('.');
}