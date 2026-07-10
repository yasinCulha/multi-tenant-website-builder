import "./bootstrap";

import "../css/app.css";
import "../css/theme-editor.css";

import "./theme-editor";

import "./builder/builder";
import "./builder/sidebar";
import "./builder/preview";
import "./builder/settings";
import "./builder/dragdrop";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
