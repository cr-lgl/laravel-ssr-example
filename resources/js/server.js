import app from './app';
import renderVueComponentToString from 'vue-server-renderer/basic';

renderVueComponentToString(app, (err, html) => {
    if (err) {
        throw new Error(err);
    }

    const meta = app.$meta().inject();

    dispatch({
        html: html,
        vueMeta: {
            htmlAttrs: meta.htmlAttrs.text(true),
            headAttrs: meta.headAttrs.text(),
            head: meta.head(true),
            bodyAttrs: meta.bodyAttrs.text(),
            bodyPrepend: meta.bodyPrepend(true),
            bodyAppend: meta.bodyAppend(true),
        },
    });
});
