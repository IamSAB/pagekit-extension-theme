// Base
Section =  require('./setting/Section.vue');
Position = require('./setting/Position.vue');

// Top
const SectionTopA = {
        extends: Section,
        path: 'Top.A.Section'
    },
    SectionTopB = {
        extends: Section,
        path: 'Top.B.Section'
    },
    PositionTopA = {
        extends: Position,
        path: 'Top.A.Position'
    },
    PositionTopB = {
        extends: Position,
        path: 'Top.B.Position'
    }

// Main
const SectionMain = {
    extends: Section,
        path: 'Main.Section'
    },
    PositionMainTop = {
        extends: Position,
        path: 'Main.Top.Position'
    },
    PositionMainBottom = {
        extends: Position,
        path: 'Main.Bottom.Position'
    }

// Bottom
const SectionBottomA = {
        extends: Section,
        path: 'Bottom.A.Section'
    },
    SectionBottomB = {
        extends: Section,
        path: 'Bottom.B.Section'
    },
    PositionBottomA = {
        extends: Position,
        path: 'Bottom.A.Position'
    },
    PositionBottomB = {
        extends: Position,
        path: 'Bottom.B.Position'
    }

// Foot
const SectionFoot = {
        extends: Section,
        path: 'Foot.Section'
    },
    PositionFoot = {
        extends: Position,
        path: 'Foot.Position'
    }

module.exports = {

    extends: require('./UI.vue'),

    section: {
        label: 'Theme',
        priority: 90
    },

    props: {
        node: {
            type: Object,
            required: true
        }
    },

    created () {
        this.sorting = ['Head','Top','Main','Bottom','Foot'];
        this.theme = this.node.theme;
    },

    events: {
        'setting.update': function (name, value) {
            console.log(name);
            console.log('SETTING.UPDATE');
            this.node.theme[name] = value;
        }
    },

    components: {
        SectionTopA,
        SectionTopB,
        PositionTopA,
        PositionTopB,
        SectionMain,
        PositionMainTop,
        PositionMainBottom,
        SectionBottomA,
        SectionBottomB,
        PositionBottomA,
        PositionBottomB,
        SectionFoot,
        PositionFoot
    }
}

window.Site.components['node-theme'] = module.exports;
