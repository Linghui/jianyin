var MyScene = cc.Scene.extend({
    onEnter: function() {
        this._super();
        var size = cc.director.getWinSize();
        var sprite = cc.Sprite.create("HelloWorld.png");
        sprite.setPosition(size.width / 2, size.height / 2);
        sprite.setScale(0.8);
        this.addChild(sprite, 0);

        var label = cc.LabelTTF.create("Hello World", "Arial", 40);
        label.setPosition(size.width / 2, size.height / 2);
        this.addChild(label, 1);

        var drawNode = new cc.DrawNode();

        this.addChild(drawNode,2);              //加入Layer层

        drawNode.clear()                      //清除节点缓存

        drawNode.ctor()                       //构造函数
        drawNode.drawDot(cc.p(60, 100), 1000, cc.color(0.5,0.6,0,1));
    }
});
