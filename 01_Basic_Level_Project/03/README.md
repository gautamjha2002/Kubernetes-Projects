# Todo App with Kubernetes and Jenkins

This project demonstrates the use of Kubernetes and Jenkins for deploying and managing a todo application built with HTML, CSS, JavaScript, PHP, and MySQL

## Prerequisites
* Docker
* Kubernetes
* Jenkins

## Project Structure

* **todo-app:** The todo application code.
* **Kubernetes:** The Kubernetes configuration files for deploying the application on a Kubernetes cluster.
* **Jenkinsfile:** A Jenkins pipeline file that defines the steps for building the Docker image, pushing it to Docker Hub, and deploying it on Kubernetes.

## Automating the Deployment with Jenkins

1. Set up a Jenkins server
2. Connect you kubernetes Master node as Jenkins slave
3. create a new pipeline job.
4. Configure the pipeline to fetch the code from this GitHub repository.
5. Run the pipeline and it should build the Docker image, push it to Docker Hub, and deploy it on Kubernetes.

# Notes
* Make sure you edit the Jenkinsfile before using it, You have to edit the DOCKER_USER environment variable and set the value to your ows username
* In your Jenkins Server make sure you have already created a credential for you Dockerlogin paasword and name it as `dockerlogin` otherwise you have to change the Jenkinsfile.
* when you are joining your Kubernetes control plane as slave of jenkins you have given it label as `kube` else you can change it whatever you want in the Jenkinsfile.

# ScreenShots

### Jenkins Pipeline
![Jenkins CD](https://github.com/gautamjha2002/Kubernetes-Projects/blob/master/01_Basic_Level_Project/03/ScreeShots/Jenkins_CD.png)

### Image on DockerHub 
![DockerHib Image](https://github.com/gautamjha2002/Kubernetes-Projects/blob/master/01_Basic_Level_Project/03/ScreeShots/DockerHub.png)

### AWS Control Plane CLI
![AWS_Control_plane_CLI.png](https://github.com/gautamjha2002/Kubernetes-Projects/blob/master/01_Basic_Level_Project/03/ScreeShots/AWS_Control_plane_CLI.png)

### Application 
![Application.png](https://github.com/gautamjha2002/Kubernetes-Projects/blob/master/01_Basic_Level_Project/03/ScreeShots/Application.png)

