"use strict";

export default class Balle
{
    constructor(canvas)
    {
        this.canvas = canvas;
        this.ctx = canvas.getContext("2d");
        this.r = this.rand(10, 100);
        this.x = this.rand(this.r, canvas.width-this.r);
        this.y = this.rand(this.r, canvas.height-this.r);
        this.vx = this.rand(2, 10, true);
        this.vy = this.rand(2, 10, true);
        this.color = this.randColor();
    }
    rand(min = 0, max= 100, negative=false)
    {
        if(negative)
        {
            const n = Math.random()<0.5?-1:1;
            return Math.floor(Math.random()*n*(max-min))+min;
        }
        return Math.floor(Math.random()*(max-min))+min;
    }
    randColor()
    {
        return "#"+ Math.floor(Math.random()*16_777_215).toString(16);
    }
    draw()
    {
        const ctx = this.ctx;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.r, 0, 2*Math.PI);
        ctx.strokeStyle = this.color;
        ctx.fillStyle = this.color;
        ctx.fill();
        ctx.stroke();
        this.move();
    }
    move()
    {
        if(this.x+this.r> this.canvas.width || this.x-this.r <0)
        {
            this.vx = -this.vx
        }
        if(this.y+this.r> this.canvas.height || this.y-this.r <0)
        {
            this.vy = -this.vy
        }
        this.x += this.vx;
        this.y += this.vy;
    }
}
