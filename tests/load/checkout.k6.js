import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
  scenarios: {
    checkout_smoke: {
      executor: 'ramping-vus',
      stages: [
        { duration: '1m', target: 50 },
        { duration: '3m', target: 200 },
        { duration: '1m', target: 0 },
      ],
    },
  },
  thresholds: {
    http_req_failed: ['rate<0.01'],
    http_req_duration: ['p(95)<500'],
  },
};

const BASE_URL = __ENV.BASE_URL || 'http://127.0.0.1:8000/api';
const TOKEN = __ENV.API_TOKEN;
const PRODUCT_ID = Number(__ENV.PRODUCT_ID || 1);

export default function () {
  const headers = {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  };

  if (TOKEN) {
    headers.Authorization = `Bearer ${TOKEN}`;
  }

  const home = http.get(`${BASE_URL}/home`, { headers });
  check(home, {
    'home status is 200': (r) => r.status === 200,
  });

  if (TOKEN) {
    const payload = JSON.stringify({
      whatsapp_number: '+967700000000',
      notes: 'k6 checkout race-condition test',
      items: [{ product_id: PRODUCT_ID, quantity: 1 }],
    });

    const checkout = http.post(`${BASE_URL}/checkout/process`, payload, { headers });
    check(checkout, {
      'checkout accepted or stock validation': (r) => [201, 422].includes(r.status),
    });
  }

  sleep(1);
}
