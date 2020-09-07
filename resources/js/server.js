import renderVueComponentToString from 'vue-server-renderer/basic';
import app from './app';
import router from './router';

(async () => {
    await new Promise((resolve, reject) => {
        router.push(context.url);
        router.onReady(() => {
            const matchedComponents = router.getMatchedComponents();
            if (!matchedComponents.length) {
                return reject({ code: 404 });
            }
            resolve(app);
        }, reject);
    });

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
    })
})();
