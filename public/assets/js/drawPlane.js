function drawPlane  (canvas) {

    var unit= 50,canvas, context, canvas2, context2,
        height, width, xAxis, yAxis,
        draw;

    function init(canvas) {

        context = canvas.getContext("2d");

        height = canvas.height;
        width = canvas.width;

        xAxis = Math.floor(height / 2);
        yAxis = Math.floor(width / 4);

        context.save();
        draw();

    }

    draw = function () {
        context.clearRect(0, 0, width, height);
        grd = context.createLinearGradient(0.000, 0.000, 800.000, 0.000);
        grd.addColorStop(0, 'rgba(220, 53, 69, 1.000)');
        grd.addColorStop(1, 'rgba(245, 223, 22, 0.0)');
        context.strokeStyle = grd;
        context.lineWidth = 2;
        context.beginPath();
        drawSine(draw.t, unit, 0, 1);
        context.stroke();
        drawPlane(draw.t, unit, 0, 1);
        grd = context.createLinearGradient(0.000, 0.000, 800.000, 0.000);
        grd.addColorStop(0, 'rgba(15, 61, 127, 1.000)');
        grd.addColorStop(1, 'rgba(151, 204, 18, 0.000)');
        context.strokeStyle = grd;
        context.beginPath();
        drawSine(draw.t, unit*2, 50, -1);
        context.stroke();
        drawPlane(draw.t, unit*2, 50, -1 );
        grd = context.createLinearGradient(0.000, 0.000, 800.000, 0.000);
        grd.addColorStop(0,  'rgba(220, 53, 69, 1.000)');
        grd.addColorStop(1, 'rgba(245, 223, 22, 0.0)');
        context.strokeStyle = grd;
        context.beginPath();
        drawSine(draw.t, unit*2, 100, 1);
        context.stroke();
        drawPlane(draw.t, unit*2, 100, 1 );

        grd = context.createLinearGradient(0.000, 0.000, 800.000, 0.000);
        grd.addColorStop(0,  'rgba(15, 61, 127, 1.000)');
        grd.addColorStop(1, 'rgba(151, 204, 18, 0.000)');
        context.strokeStyle = grd;

        context.beginPath();
        drawSine(draw.t, unit*1/150, 150, -1);
        context.stroke();

        drawPlane(draw.t, unit*1/150, 150, -1 );

        context.restore();

        draw.seconds = draw.seconds - .007;
        draw.t = draw.seconds * Math.PI;
        setTimeout(draw , 35);
    };

    draw.seconds = 0;
    draw.t = 0;

    function drawSine(t, unitval, offset, direction) {

        for (i = yAxis; i <= width; i += 10) {
            x = t + (-yAxis + i) / unitval;
            y = Math.sin(x) * direction;
            context.lineTo(i + offset , (unitval / 3) * y + xAxis);
        }
    }

    function drawPlane(t, unitVal, offset, direction) {

        var y = xAxis + (unitVal / 3) * Math.sin(t) * direction;
        var img = new Image();
        img.src = "https://i.imgur.com/bYuAw4C.png";
        context.beginPath();
        context.drawImage(img, yAxis - 29  + offset , y - 16 );
        context.stroke();
    }

    init(canvas);


}