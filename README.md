# Inception - A Dockerized Web Infrastructure

![42 Project](https://img.shields.io/badge/42%20Project-Inception-blue) ![Docker](https://img.shields.io/badge/Docker-2496ED?logo=docker&logoColor=white) ![Docker Compose](https://img.shields.io/badge/Docker%20Compose-384d54?logo=docker&logoColor=white) ![NGINX](https://img.shields.io/badge/NGINX-009639?logo=nginx&logoColor=white) ![WordPress](https://img.shields.io/badge/WordPress-21759B?logo=wordpress&logoColor=white) ![MariaDB](https://img.shields.io/badge/MariaDB-003545?logo=mariadb&logoColor=white)

Inception is a system administration project that demonstrates how to deploy a multi-container web application stack using Docker and Docker Compose. The primary goal is to build the required Docker images for each service from scratch, orchestrate them to communicate over a private network, and ensure data persistence and security.

This project serves as a practical introduction to containerization, infrastructure-as-code principles, and modern web server architecture.

## 🏛️ Core Architecture

The architecture is designed around the principles of isolation, security, and persistence. All services are containerized and communicate exclusively over a custom Docker network, with NGINX acting as the sole entry point.

*   **Single Entry Point**: All incoming traffic is routed through the NGINX container on port 443 (HTTPS). No other service is exposed directly to the host machine.
*   **Isolated Network**: A dedicated Docker bridge network (`inception`) allows services to communicate securely by name (e.g., `wordpress` can reach `mariadb`).
*   **Persistent Data**: Docker volumes are used for the WordPress files and the MariaDB database to ensure that data survives container restarts and updates.
*   **Security First**: Passwords and sensitive data are managed using Docker secrets and environment variables, never hardcoded into `Dockerfile`s.

## 🔧 Services Deployed

The infrastructure is composed of a core stack and several bonus services that extend its functionality.

### Core Stack
| Service | Description | Docker Image Base |
| :--- | :--- | :--- |
| **NGINX** | The reverse proxy and TLS termination point. It serves the WordPress site and routes requests to other services like Adminer and Grafana. Enforces **TLS v1.3** for all connections. | `alpine:3.20` |
| **WordPress** | The content management system, running on **PHP-FPM**. It is installed and configured automatically at startup using `wp-cli`. | `debian:bullseye` |
| **MariaDB** | The relational database that stores all WordPress data (posts, users, settings). The database and users are initialized automatically on the first run. | `debian:bullseye` |

### Bonus Services
| Service | Description |
| :--- | :--- |
| **Redis** | An in-memory cache connected to WordPress to significantly improve site performance by reducing database queries. |
| **FTP Server** | A secure FTP server (`vsftpd`) providing access to the WordPress volume for easy file management. |
| **Adminer** | A lightweight, web-based database management tool for interacting with the MariaDB database. |
| **Monitoring Stack** |
| &nbsp;&nbsp;&nbsp;↳ **Prometheus** | A monitoring system that scrapes metrics from other services. |
| &nbsp;&nbsp;&nbsp;↳ **Grafana** | A visualization dashboard to display metrics collected by Prometheus. |
| &nbsp;&nbsp;&nbsp;↳ **cAdvisor** | A Google tool that collects metrics about container resource usage. |
| **Hugo** | A static site generator serving a custom project checklist page (this page!), demonstrating NGINX's ability to proxy multiple distinct services. |

## ✨ Technical Highlights

*   **Custom Docker Images**: Every service runs on a custom image built from a `Dockerfile`, with no pre-built images pulled from Docker Hub.
*   **Automated Setup**: Entrypoint scripts automate the entire setup process, including database initialization, WordPress installation (`wp-cli`), and SSL certificate generation.
*   **Secure Configuration**:
    *   All traffic is encrypted using self-signed SSL certificates.
    *   Strict adherence to **TLS v1.3**.
    *   Passwords are managed via Docker secrets and injected at runtime.
*   **Data Persistence**: Named Docker volumes ensure that WordPress content and database files are stored on the host machine and are not lost when containers are removed.
*   **Clean Management**: A `Makefile` provides simple commands to build, start, stop, and clean the entire infrastructure.

## 🚀 Getting Started

### Prerequisites
*   Docker Engine
*   Docker Compose

### Installation

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/your-username/inception.git
    cd inception
    ```

2.  **Configure Your Domain**
    For local testing, add your domain to your system's `hosts` file.
    ```bash
    sudo nano /etc/hosts
    ```
    Add the following line:
    ```
    127.0.0.1 your-domain.42.fr
    ```
    *(Replace `your-domain.42.fr` with the `DOMAIN_NAME` you set in the `.env` file).*

3.  **Set Up Environment Variables**
    Review the `srcs/.env` and `secrets/` files to configure your domain name, database credentials, and user passwords.

4.  **Build and Run**
    Use the Makefile to launch the entire stack. This command will build the images and start the containers in detached mode.
    ```bash
    make
    ```

### Accessing Services
*   **WordPress Site**: `https://your-domain.42.fr`
*   **Adminer**: `https://your-domain.42.fr/adminer/`
*   **Grafana**: `https://your-domain.42.fr/grafana/`
*   **Hugo Checklist**: `https://your-domain.42.fr/hugo/`

## 📜 Makefile Commands

| Command | Description |
| :--- | :--- |
| `make` or `make up` | Builds the Docker images and starts all services in detached mode. |
| `make down` | Stops and removes all running containers. |
| `make re` | Stops, removes, and restarts all containers. |
| `make fdown` | Stops all containers, removes them, deletes all images and volumes (cleans all data). |
| `make prune` | A more aggressive clean that removes all unused Docker data from the system. |
| `make logs` | Tails the logs from all running services. |

## 👤 Author

*   **A. Duvillaret** ([C0rvax](https://github.com/C0rvax))
