const $$ = DOMElementString => document.querySelector(DOMElementString); // look mom i made jquery

export const html = $$('html');
export const body = $$('body');
export const header = $$('header.k-header');
export const getsHeaderMargin = $$('.k-headermargin');
export const $doc = $(document);