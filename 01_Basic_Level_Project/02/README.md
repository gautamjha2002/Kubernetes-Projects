# Project Idea

## Setting up a multi-tiered application on Kubernetes
This project involves deploying a more complex application on a Kubernetes cluster, such as a multi-tiered web application with a front-end, a back-end, and a database. You can learn how to use Kubernetes objects such as StatefulSets and PersistentVolumeClaims to manage the components of a multi-tiered application, and how to use ingress controllers to expose them to the outside world.

# Project 

## To-Do Application

This repository contains the source code and Kubernetes configuration files for a multi-tiered to-do application. The application consists of a front-end written in HTML, CSS, and JavaScript, a back-end written in PHP, and a MySQL database.

### Prerequisites
* Docker
* Kubernetes

### Getting Started

1. Build the Docker image for the front-end and backend application:

``docker build -t <Your DockerHub Registry username>/todo-app .``

2. Push the Docker image to a registry:

``docker push <Your_DockerHub_Registry_username>/todo-app``

3. Create the Kubernetes objects for the application:

```commandline
kubectl apply -f Kubernetes/configmap.yml
kubectl apply -f Kubernetes/secrets.yml
kubectl apply -f Kubernetes/pv_storageclass.yml
kubectl apply -f Kubernetes/database_pv.yml
kubectl apply -f Kubernetes/database_pvc.yml
kubectl apply -f Kubernetes/database_statefulset.yml
kubectl apply -f Kubernetes/database_service.yml
kubectl apply -f Kubernetes/app_deployment.yml
kubectl apply -f Kubernetes/web_app_service.yml
kubectl apply -f Kubernetes/app_ingress.yml
```
4. Access the application at the hostname specified in the app_ingress.yml file.

NOTE: **The hostname specified in the app_ingress.yml file will not work unless it is a registered domain name. To access the application, you will need to use the IP address of the Ingress controller or the NodePort of the web-app-service Service.**

### Configuration
The configuration for the front-end and back-end applications is stored in the configmap.yml file. You can update the values in this file to change the configuration of the application.

### Troubleshooting
If you encounter any issues while deploying or running the application, you can check the logs of the front-end and back-end pods by running the following commands:

```commandline
kubectl logs -f <front-end-pod-name>
kubectl logs -f <back-end-pod-name>

```

You can also check the logs of the MySQL database by connecting to the database and running the SHOW LOGS command.
    

