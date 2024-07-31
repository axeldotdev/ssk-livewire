import './bootstrap'

const driverInstance = driver()

for (const element of document.querySelectorAll('[data-hotkey]')) {
  install(element);
}
