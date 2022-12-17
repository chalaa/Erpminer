function hoverDiv(div){

    const popup = $(div).parent().parent().next()
    popup.addClass("d-md-block")
    return false;
}

function mouseLeave(div){

    const popup = $(div).parent().parent().next()
    popup.removeClass("d-md-block");
    return false;
}


function hoverUser(div){

    const popup = $(div).parent().next()
    popup.addClass("d-md-block")
    popup.parent().addClass("bg-light")
    return false;
}

function mouseLeaveUser(div){

    const popup = $(div).parent().next()
    popup.removeClass("d-md-block");
    popup.parent().removeClass("bg-light")
    return false;
}
