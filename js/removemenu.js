(function($) {
    const hpJs = {
        init: function() {
            this.wpMenuItem = "#menu-to-edit .menu-item";
            this.wpDeleteBtn = ".item-delete";
            this.hpDeleteBtn = "hp-menu-delete";

            this.deleteThisText = "x";
            this.deleteThisDesc = "Delete this menu item";

            this.deleteAllText = "xx";
            this.deleteAllDesc = "Delete this & all sub-menu items";

            this.customRemove();
        },

        customRemove: function() {
            const self = this;
            $(self.wpMenuItem).each(function() {
                const thisMenu = $(this);
                const itemControls = thisMenu.find('.item-controls').find('.item-type');

                // Delete this
                $("<a/>", {
                    "class": self.hpDeleteBtn,
                    text: self.deleteThisText,
                    title: self.deleteThisDesc,
                    click: function() {
                        thisMenu.find('.menu-item-settings').find(self.wpDeleteBtn).trigger('click');
                        return false;
                    }
                }).insertBefore(itemControls);

                // Delete all
                $("<a/>", {
                    "class": self.hpDeleteBtn,
                    text: self.deleteAllText,
                    title: self.deleteAllDesc,
                    click: function() {
                        // Get the level of this menu item
                        const menuLevel = self.menuLevel(thisMenu);
                        // Remove all children menu items
                        thisMenu.nextUntil(".menu-item-depth-" + (menuLevel)).remove();
                        // Remove this menu item
                        thisMenu.remove();
                        return false;
                    }
                }).insertBefore(itemControls);
            });
        },

        menuLevel: function() {
            const tclass = this.wpMenuItem.attr("class");
            const levelClass = tclass.match(/menu-item-depth-[0-9]+/);
            const level = parseInt(levelClass[0].replace("menu-item-depth-", ""), 10);
            return level;
        }
    };

    hpJs.init();
})(jQuery);
