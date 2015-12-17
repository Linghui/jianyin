Config.winSize = cc.size(720, 1134);
Config.w = Config.winSize.width;
Config.h = Config.winSize.height;
Config.w_2 = Config.w / 2;
Config.h_2 = Config.h / 2;

var LoaderLayer = cc.LayerColor.extend({
    count: 0,
    ctor: function() {
        this._super(cc.color(0, 0, 0, 160));
        var draw = new cc.DrawNode();
        draw.x = Config.w_2 - 50;
        draw.y = 260;

        for (var i = 0; i < 3; i++) {
            draw.drawRect(cc.p(40 * i, 0), cc.p(40 * i + 20, 20), cc.color(181, 181, 181), 1, cc.color(181, 181, 181));
        }
        var draw2 = this.draw = new cc.DrawNode();
        draw2.x = Config.w_2 - 50;
        draw2.y = 260;
        draw2.drawRect(cc.p(0, 0), cc.p(20, 20), cc.color(239, 178, 82), 1, cc.color(239, 178, 82));
        this.addChild(draw);
        this.addChild(draw2);
        this.schedule(this.updateLoad, 0.2);
        return true;
    },
    updateLoad: function() {
        var draw = this.draw;
        draw.clear();
        if (this.count > 3) {
            this.count = 0;
        }
        for (var i = 0; i < this.count; i++) {
            draw.drawRect(cc.p(40 * i, 0), cc.p(40 * i + 20, 20), cc.color(239, 178, 82), 1, cc.color(239, 178, 82));
        }
        this.count++;
    },
    onRemove: function() {
        var parent = this.parent;
        cc.eventManager.resumeTarget(parent, true);
        parent.resume();
        parent.removeChild(this, true);
    }
});

LoaderLayer.preload = function(url, data, cb, parent) {
    var loader = cc.LoaderLayer;
    if (!loader) {
        loader = new LoaderLayer();
    }
    //parent.pause();
    cc.eventManager.pauseTarget(parent, true);
    parent.addChild(loader, 99);
    Utils.ajax({
        url: url,
        type: "POST",
        data: data,
        success: function(data) {
            loader.onRemove();
            cb(data);
        },
        error: function(xhr, status, msg) {
            loader.onRemove();
            alert(msg);
        }
    });
};
