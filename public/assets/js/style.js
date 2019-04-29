(function () {

    var unit= 50,canvas, context, canvas2, context2,
        height, width, xAxis, yAxis,
        draw;

    /**
     * Init function.Initialize variables and begin the animation.
     */
    function init() {

        canvas = document.getElementById("sineCanvas");
        context = canvas.getContext("2d");

        height = canvas.height;
        width = canvas.width;

        xAxis = Math.floor(height / 2);
        yAxis = Math.floor(width / 4);

        context.save();
        draw();

    }

    /**
     * Draw animation function.
     *
     * This function draws one frame of the animation, waits 25ms, and then calls
     * itself again.
     */
    draw = function () {
        // Clear the canvas
        context.clearRect(0, 0, width, height);

        // BLUE gradient
        grd = context.createLinearGradient(0.000, 0.000, 800.000, 0.000);
        grd.addColorStop(0, 'rgba(189, 106, 155, 1.000)');
        grd.addColorStop(1, 'rgba(189, 106, 155, 0.00)');
        context.strokeStyle = grd;
        context.lineWidth = 2;
        // BLUE sine
        context.beginPath();
        drawSine(draw.t, unit, 0, 1);
        context.stroke();
        //BLUE plane
        drawPlane(draw.t, unit, 0, 1);

        //GREEN gradient
        grd = context.createLinearGradient(0.000, 0.000, 800.000, 0.000);
        grd.addColorStop(0, 'rgba(151, 204, 18, 1.000)');
        grd.addColorStop(1, 'rgba(151, 204, 18, 0.000)');
        context.strokeStyle = grd;
        // GREEN sine
        context.beginPath();
        drawSine(draw.t, unit*2, 50, -1);
        context.stroke();
        // GREEN plane
        drawPlane(draw.t, unit*2, 50, -1 );

        //YELLOW Gradient
        grd = context.createLinearGradient(0.000, 0.000, 800.000, 0.000);
        grd.addColorStop(0,  'rgba(245, 223, 22, 1.000)');
        grd.addColorStop(1, 'rgba(245, 223, 22, 0.0)');
        context.strokeStyle = grd;
        //YELLOW sine
        context.beginPath();
        drawSine(draw.t, unit*2, 100, 1);
        context.stroke();
        //YELLOW plane
        drawPlane(draw.t, unit*2, 100, 1 );

        //RED Gradient
        grd = context.createLinearGradient(0.000, 0.000, 800.000, 0.000);
        grd.addColorStop(0,  'rgba(204, 63, 24, 1.000)');
        grd.addColorStop(1, 'rgba(204, 63, 24, 0.000)');
        context.strokeStyle = grd;
        //RED sine
        context.beginPath();
        drawSine(draw.t, unit*1/150, 150, -1);
        context.stroke();
        //RED plane
        drawPlane(draw.t, unit*1/150, 150, -1 );

        // Restore original styles
        context.restore();


        // Update the time and draw again
        draw.seconds = draw.seconds - .007;
        draw.t = draw.seconds * Math.PI;
        setTimeout(draw , 35);
    };

    draw.seconds = 0;
    draw.t = 0;


    /**
     * Function to draw sine
     *
     * The sine curve is drawn in 10px segments starting at the origin.
     */
    function drawSine(t, unitval, offset, direction) {

        // Loop to draw segments
        for (i = yAxis; i <= width; i += 10) {
            x = t + (-yAxis + i) / unitval;
            y = Math.sin(x) * direction;
            context.lineTo(i + offset , (unitval / 3) * y + xAxis);
        }
    }



    /**
     * Function to draw arrow
     */
    function drawPlane(t, unitVal, offset, direction) {

        // Cache position of arrow on the circle
        var y = xAxis + (unitVal / 3) * Math.sin(t) * direction;
        var img = new Image();
        img.src = "http://i.imgur.com/LsYmdkL.png";
        //img.src = "https://i.imgur.com/bYuAw4C.png";
        // Draw yAxis bead
        context.beginPath();
        context.drawImage(img, yAxis - 29  + offset , y - 16 );
        //context.arc(yAxis, y, 5, 0, 2*Math.PI, false);
        context.stroke();
    }

    init();

})();