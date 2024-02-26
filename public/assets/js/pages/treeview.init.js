"use strict";

$(function() {
    $("#jstree-1").jstree({
        plugins: ["types"],
        core: {
            themes: {
                ellipsis: true
            }
        },
        types: {
            default: {
                icon: "far fa-user"
            },
            file: {
                icon: "far fa-user"
            }
        }
    });
});