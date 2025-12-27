// Preload for VNPay payment window
// Ensures global timer variables exist so VNPay scripts relying on them do not throw
(() => {
  try {
    if (typeof window !== 'undefined') {
      if (typeof window.timer === 'undefined') {
        window.timer = null;
      }
      if (typeof window.VNPayTimer === 'undefined') {
        window.VNPayTimer = null;
      }
    }
  } catch (error) {
    // Swallow errors to avoid breaking the payment window
    console.error('VNPay preload failed:', error);
  }
})();
