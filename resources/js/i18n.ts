import { createI18n } from "vue-i18n"
import en from "./locales/en.json"
import fr from "./locales/fr.json"

const browserLocale = (typeof navigator !== "undefined" ? navigator.language : "en").split("-")[0]
const fallback = "en"
const supported = ["en", "fr"]
const locale = supported.includes(browserLocale) ? browserLocale : fallback

export const i18n = createI18n({
    legacy: false,
    locale,
    fallbackLocale: fallback,
    messages: { en, fr },
})
