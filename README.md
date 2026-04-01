# cybersecurity-projects
some of my projects as an engineering student
cybersecurity-projects/Cloud-computing-projects/
│
├── nginx/
│   └── webapp.conf
│
├── web_server_1/
│   └── app.py
│
├── web_server_2/
│   └── app.py
│
├── monitoring/
│   └── prometheus.yml
│
└── README.md
# Cloud Deployment Simulation

This project simulates a cloud infrastructure using virtual machines.

## Architecture

- Nginx proxy (reverse proxy + load balancer)
- 2 web servers (Flask apps)
- Monitoring VM (Prometheus + Grafana)

## Features

- Reverse proxy with Nginx
- HTTPS with self-signed certificate
- Load balancing (Round Robin)
- Monitoring using Prometheus and Grafana

## How to run

1. Start all VMs
2. Run Flask apps on both servers
3. Start Nginx
4. Access via browser:
   https://<PROXY_IP>

## Monitoring

- Prometheus: http://<MONITORING_IP>:9090
- Grafana: http://<MONITORING_IP>:3000
